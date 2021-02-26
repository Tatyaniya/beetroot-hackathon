jQuery(function($){
    function editContent() {
        const focusField = $("[contenteditable='true']");
        console.log(focusField);
        focusField.on("click", function () {
            $.ajax({
                type: "POST",
                url: themeVars.adminUrl,
                data: {
                    action: "edit_content",
                },
                success: function (jsonData) {
                    var data = JSON.parse(jsonData);
                    console.log(data);
                },
                error: function (MLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                },
            });
        });
    }


    $(document).ready(() => {
        editContent();
    });
});


window.addEventListener('DOMContentLoaded', function() {
    count();
})
window.addEventListener('load', function() {
    changeNumber();
})

function changeNumber() {
    const data = document.querySelectorAll(".check .repeater__row");
    data.forEach(element => {
        const hours = element.querySelector(".repeater__hours");
        const rate = element.querySelector('.repeater__rate');
        hours.addEventListener('blur', function() {
            count();
        })
        rate.addEventListener('blur', function() {
            count();
        })
    });
}

function count() {
    const data = document.querySelectorAll(".check .repeater__row");
    const totalText = document.querySelector('.check .total__cost');
    let totalSum = Number(0);

    data.forEach(element => {
        const hours = element.querySelector(".repeater__hours").innerHTML;
        const rate = element.querySelector('.repeater__rate').innerHTML.slice(1);
        const total = element.querySelector(".repeater__total");
        const sum = hours * rate;
        total.innerHTML = "$" + sum;
    });

    data.forEach(element => {
        const total = element.querySelector(".repeater__total").innerHTML.slice(1);
        totalSum += Number(total);
    });
    totalText.innerHTML = "$" + totalSum;
}