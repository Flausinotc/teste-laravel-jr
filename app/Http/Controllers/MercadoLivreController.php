<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class MercadoLivreController extends Controller
{
    public function redirectToMercadoLivre()
    {
        $clientId = env('MERCADO_LIVRE_CLIENT_ID');
        $redirectUri = env('MERCADO_LIVRE_REDIRECT_URI');
        $authUrl = "https://auth.mercadolivre.com.br/authorization?response_type=code&client_id={$clientId}&redirect_uri={$redirectUri}";

        return redirect($authUrl);
    }

    public function handleMercadoLivreCallback(Request $request)
    {
        if (!$request->has('code')) {
            return redirect('/')->with('error', 'Código de autorização não encontrado.');
        }

        $code = $request->code;
        $client = new Client();

        try {
            $response = $client->post('https://api.mercadolibre.com/oauth/token', [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'client_id' => env('MERCADO_LIVRE_CLIENT_ID'),
                    'client_secret' => env('MERCADO_LIVRE_CLIENT_SECRET'),
                    'code' => $code,
                    'redirect_uri' => env('MERCADO_LIVRE_REDIRECT_URI'),
                ],
            ]);

            $token = json_decode($response->getBody(), true)['access_token'];
            session(['mercado_livre_token' => $token]);

            return redirect('/produtos/cadastrar');
        } catch (RequestException $e) {
            Log::error('Erro ao obter token do Mercado Livre: ' . $e->getMessage());

            if ($e->hasResponse()) {
                $responseBody = $e->getResponse()->getBody()->getContents();
                Log::error('Resposta do Mercado Livre: ' . $responseBody);
            }

            return redirect('/')->with('error', 'Erro ao autenticar com o Mercado Livre.');
        }
    }
}
