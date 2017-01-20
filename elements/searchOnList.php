<h5>Поиск по списку:</h5>
<input type="text" name="searchBox" id="input2"><button class="action greenbtn" type="submit" name="subSearch" onclick="return setSelected()"><span class="label">Отметить</span></button>

<h5></h5>
<script>
    function setSelected() {
        var optionFields = document.getElementsByTagName('option');
        var matches = GetText(document.getElementsByName('searchBox').item(0).value);
        var countMatches = matches.length;
        var count = 0;

        for (var i = 0, len = optionFields.length; i < len; i++) {
            var m = 0;
            for (var r = 0; r <countMatches; r++) {
                if (matches[r][0] == " ")
                {
                    matches[r] = matches[r].substr(1);
                }

                if (optionFields[i].text.indexOf(matches[r]) != -1
                    || optionFields[i].label.indexOf(matches[r]) != -1){
                        m++;
                }
            }
            if (m == countMatches)
            {
                optionFields[i].setAttribute('selected','true');
                count++;
                optionFields[i].focus();
            }
        }

        return false;
    }

    function GetText(AInputText) {
        var VRegExp = new RegExp(/[^,]+/gi);
        var VResult = AInputText.match(VRegExp);
        return VResult;
    }
</script>