jQuery(function ($) {
    function editContent(queryVars) {
        $.ajax({
            type: "POST",
            url: themeVars.adminUrl,
            data: {
                action: "edit_content",
                queryVars: queryVars,
            },
            success: function (jsonData) {
                var data = JSON.parse(jsonData);
                console.log(data.acf_field);
                console.log(data.acf_content);
            },
            error: function (MLHttpRequest, textStatus, errorThrown) {
                alert(errorThrown);
            },
        });
    }

    function generatePDF() {
        // Choose the element that our invoice is rendered in.
        const element = document.getElementById("invoice");
        // Choose the element and save the PDF for our user.
        html2pdf()
            .from(element)
            .save();
    }

    $(document).ready(() => {
        const editableElements = $("[contenteditable='true']");
        editableElements.each(function () {
            const editableEl = $(this);
            const queryVars = editableEl.data("query-vars");
            editableEl.on("blur", function () {
                queryVars.acf_content = editableEl.text();
                editableEl.data("query-vars", queryVars);
                editContent(queryVars);
            });
        });


        const html2pdfBtn = $("#download-invoice");
        html2pdfBtn.on("click", function (e) {
            generatePDF();
        });
    });
});

window.addEventListener('DOMContentLoaded', function () {
    count();
})
window.addEventListener('load', function () {
    changeNumber();
})

function changeNumber() {
    const data = document.querySelectorAll(".check .repeater__row");
    data.forEach(element => {
        const hours = element.querySelector(".repeater__hours");
        const rate = element.querySelector('.repeater__rate');
        hours.addEventListener('blur', function () {
            count();
        })
        rate.addEventListener('blur', function () {
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
