<script>

    $(document).ready(function () {

        const tags_input = $('#tags');
        const select_tags = $('#select_tags');
        const default_tags = tags_input.val();
        let default_data = null;

        if (tags_input.val() !== null && tags_input.val().length > 0) {
            default_data = default_tags.split(',');
        }

        select_tags.select2({
            placeholder: 'لطفا تگ های خود را وارد نمایید',
            tags: true,
            data: default_data
        });

        select_tags.children('option').attr('selected', true).trigger('change');


        $('#form').submit(function (event) {

            if (select_tags.val() !== null && select_tags.val().length > 0) {
                const selectedSource = select_tags.val().join(',');
                tags_input.val(selectedSource)
            }

            else {
                tags_input.val(null)
            }

        })

    })

</script>
