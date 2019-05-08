<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail Sender</title>
</head>
<body>

    <?php

        require_once(__DIR__ . "/../src/template/TemplateManager.php");
        $templateManager = new TemplateManager(['Entreprise' => "Toto", "dd" => "TExt"]);
        $template = $templateManager->getTemplate();

        if(isset($_POST['template'])){
            $template = $templateManager->saveTemplate($_POST['template']);
            $templateManager->getParsedTemplate();
        }
    ?>

    <form action="" method="post">
        <textarea name="template"><?= $template ?></textarea>
        <br>
        <input type="submit" value="Suavgarder">
    </form>
    
</body>
</html>