<script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
<script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>


<script>
    $(document).ready(function () {
        $('#start_date_view').persianDatepicker({
            format: 'YYYY/MM/DD',
            altField: '#start_date'
        }),
            $('#end_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#end_date'
            })
    });
</script>
