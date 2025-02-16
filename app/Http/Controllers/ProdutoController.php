<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Produto;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;

class ProdutoController extends Controller
{
    // Exibe a lista de produtos
    public function index()
    {
        // Busca todos os produtos no banco de dados
        $produtos = Produto::all();

        // Retorna a view 'produtos.index' com os produtos
        return view('produtos.index', compact('produtos'));
    }

    // Exibe o formulário de cadastro
    public function create()
    {
        return view('produtos.create');
    }

    // Processa o cadastro do produto
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'categoria' => 'required|string',
            'imagem' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
        ]);

        $client = new Client();
        $token = session('mercado_livre_token');

        // Verifica se uma imagem foi enviada
        $imagemUrl = null;
        if ($request->hasFile('imagem')) {
            try {
                $imagemPath = $request->file('imagem')->getRealPath();
                $imagemMime = $request->file('imagem')->getMimeType();

                if (!in_array($imagemMime, ['image/jpeg', 'image/png', 'image/gif', 'image/webp'])) {
                    return redirect()->back()->with('error', 'O tipo de arquivo da imagem não é suportado!');
                }

                $imagemResponse = $client->post('https://api.mercadolibre.com/pictures', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                    ],
                    'multipart' => [
                        [
                            'name' => 'file',
                            'contents' => fopen($imagemPath, 'r'),
                            'filename' => $request->file('imagem')->getClientOriginalName(),
                        ],
                    ],
                ]);

                $imagemData = json_decode($imagemResponse->getBody(), true);

                // Verifica se a URL da imagem foi retornada
                if (isset($imagemData['url'])) {
                    $imagemUrl = $imagemData['url'];
                } elseif (isset($imagemData['secure_url'])) {
                    $imagemUrl = $imagemData['secure_url'];
                } else {
                    throw new \Exception('URL da imagem não foi retornada pela API.');
                }

                Log::info('URL da imagem retornada pela API: ' . $imagemUrl);
            } catch (\Exception $e) {
                Log::error('Erro ao enviar imagem para o Mercado Livre: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Erro ao enviar imagem.');
            }
        }

        // Prepara os dados do produto
        $productData = [
            'title' => $request->nome,
            'description' => $request->descricao,
            'price' => (float) $request->preco,
            'available_quantity' => (int) $request->quantidade,
            'category_id' => $request->categoria,
            'currency_id' => 'BRL', // Campo obrigatório
            'buying_mode' => 'buy_it_now', // Campo obrigatório
            'listing_type_id' => 'gold_special', // Campo obrigatório
            'condition' => 'new', // Campo obrigatório
        ];

        // Adiciona a URL da imagem, se disponível
        if ($imagemUrl) {
            $productData['pictures'] = [
                ['source' => $imagemUrl],
            ];
        }

        // Tenta criar o produto no Mercado Livre
        try {
            $response = $client->post('https://api.mercadolibre.com/items', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
                'json' => $productData,
            ]);

            $produtoData = json_decode($response->getBody(), true);

            // Salva o produto no banco de dados local
            Produto::create([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'preco' => $request->preco,
                'quantidade' => $request->quantidade,
                'categoria' => $request->categoria,
                'imagem_url' => $imagemUrl,
            ]);

            return redirect('/produtos')->with('success', 'Produto cadastrado com sucesso!');
        } catch (RequestException $e) {
            Log::error('Erro ao cadastrar produto no Mercado Livre: ' . $e->getMessage());
            Log::error('Requisição enviada: ' . json_encode($productData));

            if ($e->hasResponse()) {
                $responseBody = $e->getResponse()->getBody()->getContents();
                Log::error('Resposta do Mercado Livre: ' . $responseBody);
            }

            return redirect()->back()->with('error', 'Erro ao cadastrar produto.');
        }
    }

    // Método para enviar um produto teste diretamente
    public function enviarProdutoTeste()
    {
        $client = new Client();
        $token = session('mercado_livre_token');

        // Dados do produto teste

        $productData = [
            'title' => 'Produto de Teste',
            'description' => 'Este é um produto de teste enviado diretamente pela API.',
            'price' => 99.99,
            'available_quantity' => 10,
            'category_id' => 'MLB264330', // Alteração para uma categoria folha válida
            'currency_id' => 'BRL',
            'buying_mode' => 'buy_it_now',
            'listing_type_id' => 'gold_special',
            'condition' => 'new',
            'pictures' => [
                ['source' => 'https://http2.mlstatic.com/D_938331-MLA45268824993_032021-O.jpg'],
            ],
            'attributes' => [
                ['id' => 'BRAND', 'value_name' => 'Marca de Teste'],
                ['id' => 'MODEL', 'value_name' => 'Modelo de Teste'],
                ['id' => 'COLOR', 'value_name' => 'Preto'],
            ],
            'shipping' => [
                'mode' => 'me1', // Usando o modo de envio "me1" (padrão)
                'local_pick_up' => false,
                'free_shipping' => false,
            ],
            'location' => [
                'country' => ['name' => 'Brasil'],
                'state' => ['name' => 'São Paulo'],
                'city' => ['name' => 'São Paulo'],
            ],
        ];








        // Tenta criar o produto no Mercado Livre
        try {
            $response = $client->post('https://api.mercadolibre.com/items', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
                'json' => $productData,
            ]);

            $produtoData = json_decode($response->getBody(), true);

            // Salva o produto no banco de dados local
            Produto::create([
                'nome' => 'Produto de Teste - Brinquedo',
                'descricao' => 'Este é um produto de teste enviado diretamente pela API.',
                'preco' => 99.99,
                'quantidade' => 10,
                'categoria' => 'MLB5726',
                'imagem_url' => 'https://http2.mlstatic.com/D_938331-MLA45268824993_032021-O.jpg', // URL da imagem
            ]);

            return redirect('/produtos')->with('success', 'Produto de teste cadastrado com sucesso!');
        } catch (RequestException $e) {
            Log::error('Erro ao cadastrar produto de teste no Mercado Livre: ' . $e->getMessage());
            Log::error('Requisição enviada: ' . json_encode($productData));

            if ($e->hasResponse()) {
                $responseBody = $e->getResponse()->getBody()->getContents();
                Log::error('Resposta do Mercado Livre: ' . $responseBody);
            }

            return redirect('/produtos')->with('error', 'Erro ao cadastrar produto de teste.');
        }
    }
}
