<script>

    const printBtn = document.getElementById('print');
    printBtn.addEventListener('click', function () {
        printContent('printable');
    })


    function printContent(el) {

        const restorePage = $('body').html();
        const printContent = $('#' + el).clone();
        $('body').empty().html(printContent);
        window.print();
        $('body').html(restorePage);
    }


</script>
