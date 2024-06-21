<!DOCTYPE html>
<html>
<head>
    <title>DFA for a^n b^(2n+1)</title>
    <style>
        body { font-family: sans-serif; }
        input[type=text] { width: 200px; padding: 8px; }
        button { padding: 8px 15px; background-color: lightblue; cursor: pointer; }
    </style>
</head>
<body>
    <h1>DFA for a^n b^(2n+1)</h1>

    <form method="POST" id="dfaForm">
        <input type="text" name="inputString" placeholder="Enter a string (a's and b's)" />
        <button type="submit">Test</button>
    </form>

    <div>
        <?php
        function dfa($input) {
            $currentState = 'q0';
            $aCount = 0;
            $bCount = 0;

            foreach (str_split($input) as $symbol) {
                if (!in_array($symbol, ['a', 'b'])) {
                    return "Invalid input: contains characters other than 'a' and 'b'";
                }

                switch ($currentState) {
                    case 'q0':
                        if ($symbol == 'a') {
                            $currentState = 'q1';
                            $aCount++;
                        } else {
                            return "Not accepted: starts with 'b'";
                        }
                        break;

                    case 'q1':
                        if ($symbol == 'a') {
                            $aCount++;
                        } elseif ($symbol == 'b') {
                            $currentState = 'q2';
                            $bCount++;
                        } else {
                            return "Not accepted: unexpected symbol";
                        }
                        break;

                    case 'q2':
                        if ($symbol == 'b') {
                            $bCount++;
                        } elseif ($symbol == 'a') {
                            return "Not accepted: 'a' after 'b'";
                        } else {
                            return "Not accepted: unexpected symbol";
                        }
                        break;
                }
            }

            if ($currentState == 'q2' && $bCount == 2 * $aCount + 1) {
                return "Accepted";
            } else {
                return "Not accepted: incorrect number of b\'s";
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $inputString = $_POST["inputString"];
            $result = dfa($inputString);
            echo "<script type='text/javascript'>alert('The string \"".$inputString."\" is ".$result."');</script>";
        }
        ?>
    </div>

</body>
</html>
