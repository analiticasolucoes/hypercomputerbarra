<?php

namespace App\Controllers;

class ViewController
{
    public static function render($page, $title, $message, $returnUrl, $returnMessage, $data)
    {
        switch($page) {
            case "sucess":
                include("../app/Views/messages/{$page}.php");
                break;

            case "error":
                include("../app/Views/messages/{$page}.php");
                break;
                
            default:
                echo "<h1>Não existe a página informada!</h1>";
                break;
        }
    }

    public static function show(string $page, array $data) : string
    {
        $template = self::load($page);

        return self::feed($data, $template);
    }

    private static function load($file) : ?string
    {
        try {
            return file_get_contents($file);
        } catch (Exception $e) {
            echo "Erro ao tentar carregar template!";
            throw $e;
        }
    }

    private static function feed($data, $template) : string
    {
        if(!empty($data)) {
            foreach($data as $key => $value) {
                $table = "";
                if(is_array($value)) {
                    foreach($value as $linha) {
                        $table .= "\t<tr>\n\t\t\t<td>" . implode("</td>\n\t\t\t<td>", $linha) . "</td>\n\t\t</tr>\n\t";
                    }
                    $data[$key] = $table;
                }
            }
            foreach ($data as $key => $value) {
                $template = str_replace('{' . $key . '}', $value, $template);
            }
        }

        return $template;
    }
}