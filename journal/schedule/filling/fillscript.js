/**
 * Created by Максим Сидоров on 07.05.14.
 */
setDateOnDay();

function setDateOnDay () {
    var element = document.getElementsByName('week')[0];
    var days = ['Понедельник','Вторник','Среда','Четверг','Пятница','Суббота','Воскресенье'];
    var year = element.value.substr(0,4);
    var week = element.value.substr(6)-1;
    var d = new Date(year,0,1);
    d.setDate((d.getDate() - d.getDay() + 1) + week * 7);
    var labels = document.getElementsByClassName('label');
    for (var i = 0; i < 7; i++){
        year = d.getFullYear(); //Год
        var month = d.getMonth() + 1;month = month < 10 ? '0' + month : month; //Месяц
        var date = d.getDate() < 10 ? '0' + d.getDate() : d.getDate(); //Дата
        labels[i].innerHTML = days[i] + ' - ' + date + '.' + month + '.' + year;
        d.setDate(d.getDate() + 1);
    }
}
    $('.teacher').autocomplete({
        lookup: teachers,
        minChars: 0,
        autoSelectFirst: true,
        onSelect: function(element){
            var number = this.name.substr(7);
            document.getElementsByName('teacherId' + number)[0].value = element.id;
        }
    });

    $('.discipline').autocomplete({
        lookup: discipline,
        minChars: 0,
        autoSelectFirst: true,
        onSelect: function(element){
            var number = this.name.substr(10);
            var numberPair = number.substr(4,1);
            document.getElementsByName('disciplineId' + number)[0].value = element.id;
            document.getElementsByName('teacher' + number)[0].value = element.teacher;
            document.getElementsByName('audience' + number)[0].value = element.audience;
            document.getElementsByName('teacherId' + number)[0].value = element.teacherId;
            console.log(document.getElementsByName('teacher' + number)[0]);
            var time = document.getElementsByName('time' + number)[0];
            if (time.value == "")
            {
                time.value = timePair(numberPair);
            };
        }
    })

    $('.group').autocomplete({
        lookup: groups,
        minChars: 0,
        autoSelectFirst: true,
        onSelect: function(element){
            document.getElementsByName('disciplineGroupId')[0].value = element.id;
        }
    });

function timePair(numPair)
    {
        switch (numPair)
        {
            case '0':
                return "08:00";
            case '1':
                return "09:45";
            case '2':
                return "12:00";
            case '3':
                return "13:45";
        }
    }
