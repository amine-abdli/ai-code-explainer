<?php

$apiKey = "OPENAI KEY";

$code = $_POST['code'];

$data = [
    "model" => "gpt-4.1-mini",
    "messages" => [
        [
            "role" => "user",
            "content" => "Explain this code in simple words:\n\n" . $code
        ]
    ]
];

$ch = curl_init("https://api.openai.com/v1/chat/completions");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $apiKey"
]);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);

curl_close($ch);

$result = json_decode($response, true);

echo "<h2>Explanation:</h2>";
echo "<p>".$result["choices"][0]["message"]["content"]."</p>";

?>