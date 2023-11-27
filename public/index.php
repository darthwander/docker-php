<?php

require_once 'Autoloader.php';


$user = new User(1, 'John Doe', 'john@example.com', 'password123');

// Acesso aos dados do usuário
echo "ID: " . $user->getId() . "<br>";
echo "Name: " . $user->getName() . "<br>";
echo "Email: " . $user->getEmail() . "<br>";
echo "Password: " . $user->getPassword() . "<br>";




class CorreiosAddress {
    private $apiUrl = 'https://viacep.com.br/ws/';

    public function getAddressByCep($cep) {
        $url = $this->apiUrl . $cep . '/json/';

        // Inicializa o cURL
        $curl = curl_init($url);

        // Configura as opções do cURL
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Executa a requisição e obtém a resposta
        $response = curl_exec($curl);

        // Verifica se houve erros na requisição
        if ($response === false) {
            // Trate o erro de requisição aqui
            return false;
        }

        // Converte a resposta JSON em um array associativo
        $data = json_decode($response, true);

        // Verifica se houve erros na resposta da API dos Correios
        if (isset($data['erro']) && $data['erro']) {
            // Trate o erro retornado pela API dos Correios
            return false;
        }

        // Fecha a sessão cURL
        curl_close($curl);

        // Retorna os dados do endereço
        return $data;
    }
}

// Exemplo de uso
$correiosAddress = new CorreiosAddress();
$cep = '03944040'; // Substitua pelo CEP desejado
$result = $correiosAddress->getAddressByCep($cep);

if ($result !== false) {
    // Imprime os dados do endereço
    print_r($result);
} else {
    echo "Erro ao buscar o endereço pelo CEP.";
}
?>
