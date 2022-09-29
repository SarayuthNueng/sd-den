<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<!-- <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    body {
        max-height: 100vh;
        color: #333333;
        font-family: -apple-system, BlinkMacSystemFont, "Arial", sans-serif;
        font-size: 1rem;
    }

    /* Reset */
    input,
    select,
    textarea {
        appearance: none;
        border: none;
        box-sizing: border-box;
        display: block;
        outline: none;
        width: 100%;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    h1,
    h3,
    p {
        text-align: center;
    }

    section {
        margin: 2rem 0;
        padding: 16px;
    }

    form {
        margin: 16px auto;
        max-width: 700px;
    }

    button {
        background-color: white;
        border: 1px solid #e4e4e4;
        border-radius: 4px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.08);
        display: block;
        font-size: 1rem;
        margin: 0 auto;
        color: #333333;
        padding: 12px 40px;
        transition: all 0.1s ease-in-out;
    }

    button:hover:not([disabled]) {
        background-color: #333333;
        color: #ffffff;
        border: 1px solid #e4e4e4;
        cursor: pointer;
        transform: translateY(-1px);
        box-shadow: 0 7px 10px rgba(0, 0, 0, 0.05), 0 3px 6px rgba(0, 0, 0, 0.08);
    }

    button:disabled {
        color: #c0c0c0;
        background-color: #eeeeee;
        cursor: not-allowed;
    }

    .label {
        display: block;
        margin: 1em;
        text-align: center;
    }

    .input {
        padding: 10px;
        border: 1px solid #e4e4e4;
        border-radius: 4px;
        background-color: white;
        font-size: 1.25rem;
        text-align: center;
        margin-bottom: 1rem;
    }

    .input:focus {
        border-color: #c0c0c0;
    }

    .input::placeholder {
        color: #dddddd;
    }

    .text {
        max-width: 700px;
        margin: 2rem auto;
        padding: 1.5rem;
        line-height: 0;
    }

    .error {
        color: firebrick;
        background-color: rgba(250, 0, 0, 0.07);
    }

    .success {
        color: green;
        background-color: rgba(0, 200, 0, 0.09);
    }

    #errorMessage,
    #successMessage {
        display: none;
    }
</style> -->

<body>
    <section>
        <form action="test-submit.php" method="POST">
            <label class="label" id="InputLabel" for="citizenid">Enter your national ID</label>
            <input class="input" id="citizenid" type="tel" name="citizenid" placeholder="XXXXXXXXXXXXX" autocomplete="off" autofocus title="National ID Input" aria-labelledby="InputLabel" aria-invalid aria-required="true" required tabindex="1" />
            <button type="submit" id="button" value="confirm" tabindex="2" aria-label="Submit" disabled>Submit</button>
        </form>
        <div class="text error" id="errorMessage" aria-hidden="true" aria-label="Invalid ID" role="alert">
            <p>Invalid ID Format</p>
        </div>
        <div class="text success" id="successMessage" aria-hidden="true" aria-label="Valid ID" role="alert">
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/3.3.0/imask.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const input = document.getElementById("citizenid");
            const btn = document.getElementById("button");
            const error = document.getElementById("errorMessage");
            const success = document.getElementById("successMessage");
            const mask = new IMask(input, {
                mask: "0000000000000"
            });

            input.addEventListener("keyup", event => {
                validateInput(event, input.value.replace(/-/g, ""));
            });

            input.addEventListener("keypress", event => {
                if (event.keyCode === 13) {
                    event.preventDefault();
                    return false; // Disable enter to submit for UX
                }
            });

            //   btn.addEventListener("click", event => {
            // event.preventDefault();
            // event.stopImmediatePropagation();
            // handle submit here
            // alert("Your national ID submit value is: " + input.value.replace(/-/g, ""));
            //   });

            function validateInput(event, value) {
                const maxLength = 13;
                const regex = /^[0-9]\d*$/;
                const char =
                    String.fromCharCode(event.keyCode) || String.fromCharCode(event.which);

                if (
                    value !== undefined &&
                    value.toString().length == maxLength &&
                    value.match(regex) &&
                    validNationalID(value)
                ) {
                    btn.disabled = false;
                    input.setAttribute("aria-invalid", false);
                    error.setAttribute("aria-hidden", true);
                    success.setAttribute("aria-hidden", false);
                    error.style.display = "none";
                    success.style.display = "block";
                } else if (
                    value !== undefined &&
                    value.toString().length == maxLength &&
                    value.match(regex) &&
                    !validNationalID(value)
                ) {
                    btn.disabled = true;
                    input.setAttribute("aria-invalid", true);
                    error.setAttribute("aria-hidden", false);
                    success.setAttribute("aria-hidden", true);
                    error.style.display = "block";
                    success.style.display = "none";
                } else {
                    btn.disabled = true;
                    input.setAttribute("aria-invalid", true);
                    error.setAttribute("aria-hidden", false);
                    success.setAttribute("aria-hidden", true);
                    error.style.display = "none";
                    success.style.display = "none";
                }
            }

            function validNationalID(id) {
                if (id.length != 13) return false;
                // STEP 1 - get only first 12 digits
                for (i = 0, sum = 0; i < 12; i++) {
                    // STEP 2 - multiply each digit with each index (reverse)
                    // STEP 3 - sum multiply value together
                    sum += parseInt(id.charAt(i)) * (13 - i);
                }
                // STEP 4 - mod sum with 11
                let mod = sum % 11;
                // STEP 5 - subtract 11 with mod, then mod 10 to get unit
                let check = (11 - mod) % 10;
                // STEP 6 - if check is match the digit 13th is correct
                if (check == parseInt(id.charAt(12))) {
                    return true;
                }
                return false;
            }
        });
    </script>
</body>

</html>