<script type="text/javascript">

    function changeStatus(id, extra = null) {

        let element = $("#" + id);
        element = extra ? $("#" + id + extra)  : element
        const url = element.attr('data-url');
        const elementValue = !element.prop('checked');

        $.ajax({
            url: url,
            type: "GET",
            success: function (response) {
                handleSuccessResponse(response, element, elementValue);
            },
            error: function () {
                handleErrorResponse(element, elementValue);
            }
        });
    }


    function handleSuccessResponse(response, element, elementValue) {
        if (response.status) {
            if (response.checked) {
                updateElementStatus(element, true);
                showToast('فعال سازی موفقیت آمیز بود', 'success');
            } else {
                updateElementStatus(element, false);
                showToast('غیر فعال سازی موفقیت آمیز بود', 'success');
            }
        } else {
            updateElementStatus(element, elementValue);
            showToast('هنگام ویرایش مشکلی بوجود امده است', 'error');
        }
    }

    function handleErrorResponse(element, elementValue) {
        updateElementStatus(element, elementValue);
        showToast('ارتباط برقرار نشد', 'error');
    }

    function updateElementStatus(element, status) {
        element.prop('checked', status);
    }


    function showToast(message, type) {

        $('.toast').remove();
        const toastClass = (type === 'success') ? 'bg-success' : 'bg-danger';
        const toastTag = `
        <section class="toast" data-delay="2000">
            <section class="toast-body py-3 d-flex ${toastClass} text-white">
                <strong class="ml-auto">${message}</strong>
                <button type="button" class="mr-2 close text-white" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </section>
        </section>`;

        $('.toast-wrapper').append(toastTag);
        $('.toast').toast('show').delay(5500).queue(function () {
            $(this).remove();
        });
    }


</script>
