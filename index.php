<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Afxsoft - Password Generator</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="shortcut icon" href="favicon.ico" />
    </head>
    <body>
        <section id="wrapper">            
            <header id="header">
                <div class="top">
                    <nav class="navbar navbar-inverse" role="navigation">

                        <div class="container">

                        </div>
                    </nav>
                </div>
            </header>
            <section id="message">
                <?php include 'password.php'; ?>
            </section>
            <section id="content" class="container">
                <img src="img/logo.png" class="img-responsive logo" alt="Afdal">
                <h1>Afxsoft - Password Generator</h1>
                <div class="row">
                    <?php if (isset($_POST["passgen"])): ?>
                        <?php
                        if (is_numeric($_POST["length"])):
                            $option = array(
                                "size" => $_POST["length"],
                                "lowercase" => (!empty($_POST["lowercase"])) ? true : false,
                                "uppercase" => (!empty($_POST["uppercase"])) ? true : false,
                                "number" => (!empty($_POST["numbers"])) ? true : false,
                                "symbole" => (!empty($_POST["specialchars"])) ? true : false,
                            );
                            $password = new password();
                            $password->setOption($option);
                            ?>
                            <ul>
                                <li>Password: <?php echo $password->getMix(); ?>

                                </li>
                                <?php if (isset($_POST["hash_check"])) { ?>
                                    <li>Hash (<?php print $_POST["hash"]; ?>) : <?php print hash($_POST["hash"], $password->getMix()); ?></li>
                                <?php } ?>
                            </ul>
                        <?php else: ?>
                            <p class="error">Le nombre de caractère doit être un nombre entier.</p>
                        <?php endif; ?>
                    <?php else: ?>

                        <form class="form-horizontal" action="index.php" method="post">
                            <fieldset>
                                <legend>Choose filters :</legend>
                                <label class="checkbox">
                                    <input type="checkbox" id="idLowercase" name="lowercase" checked />Lowercase
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" id="uppercase" name="uppercase" checked />Uppercase
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" id="idNumbers" name="numbers" checked />Number
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" id="idSpecialchars" name="specialchars" />Symbole
                                </label>
                                <div class="control-group">
                                    <label class="control-label" for="idLength">Number of character</label>
                                    <div class="controls">
                                        <input type="text" id="idLength" name="length" value="10" />
                                    </div>
                                </div>
                                <p>
                                    <input type="checkbox" id="idSpecialchars" name="hash_check" />
                                    <label for="idHash">Hash</label>
                                    <select id="idHash" name="hash">
                                        <?php
                                        // On récupère une liste des algorithmes de hachage enregistrés.
                                        $hashes = hash_algos();
                                        ?>
                                        <?php foreach ($hashes as $hash): ?>
                                            <option value="<?php print $hash; ?>"><?php print $hash; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </p>
                                <button type="submit" class="btn" name="passgen">Submit</button>
                            </fieldset>
                        </form>

                    <?php endif; ?>

                </div>
            </section>
            <footer id="footer" >
                <div class="container">
                    <p>Site 2014 - Afxsoft</p>
                </div>
            </footer>
        </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>