const ajax = (url, request) => {
    let ajaxResponse;
    let json = convertData(request);

    $.ajax({
        url: url,
        type: 'post',
        data: JSON.parse(json),
        async: false,
        success: function(res) {
            ajaxResponse = res;
        }
    });
    return ajaxResponse;
}

const convertData = (data) => {
    let object = {};
    //verify if the function recived a FormData and parse to json
    if (data instanceof FormData) {
        //request = new FormData();
        data.forEach(function(value, key) {
            object[key] = value;

        });
        return JSON.stringify(object);

    } else {
        return json = JSON.stringify(data);
    }

}

function replaceAll(text, search, newstring) {
    while (text.toString().indexOf(search) != -1)
        text = text.toString().replace(search, newstring);
    return text;
}

//menu

var dropdown = document.getElementsByClassName("sider-dropdown");
var i;

for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}