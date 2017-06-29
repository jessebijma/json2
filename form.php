<form action="index.php" method="GET">
    <table>
        <tr>
            <td><label for="inputName">Name</label></td>
            <td><input type="text" id="inputName" name="name" onkeyup="getNames()" value=""></td>
        </tr>
        <tr>
            <td><label for="categorie">Categorie</label></td>
            <td><input type="text" id="categorie" name="categorie"></td>
        </tr>
        <tr>
            <td><label for="studenten">Aantal Studenten</label></td>
            <td><input type="text" id="studenten" name="studenten"></td>
        </tr>
        <tr>
            <td><label for="opleiding">Opleiding</label></td>
            <td><input type="text" id="opleiding" name="opleiding"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit"></td>
        </tr>
    </table>
</form>

<script>
    function loadJSON(path, success, error) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    if (success)
                        success(JSON.parse(xhr.responseText));
                } else {
                    if (error)
                        error(xhr);
                }
            }
        };
        xhr.open("GET", path, true);
        xhr.send();
    }


    function getNames() {

        loadJSON('schools.json',
            function (data) {
                var nameVal = document.getElementById('inputName');
                var catgVal = document.getElementById('category');
                var studVal = document.getElementById('nr_students');
                var opldVal = document.getElementById('opleiding');

                console.log(data['schools'].hasOwnProperty(nameVal.value));
                console.log(data['schools'][nameVal.value]);
                if(data['schools'].hasOwnProperty(nameVal.value)) {
                    catgVal.value = data['schools'][nameVal]['category'];
                    studVal.value = data['schools'][nameVal]['nr_students'];
                }
            },
            function (xhr) {
                console.error(xhr);
            }
        );

    }
</script>