jQuery(document).ready(function($) {
    $('#vira-filters-form').on('change', 'input, select', function() {
        const data = $('#vira-filters-form').serialize();
        $.ajax({
            url: vira_filters_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'vira_filter_products',
                filters: data
            },
            beforeSend: function() {
                $('#vira-products-results').html('<p>Cargando productos...</p>');
            },
            success: function(response) {
                $('#vira-products-results').html(response);
            }
        });
    });

    $('.vira-reset-button').on('click', function() {
        $('#vira-filters-form')[0].reset();
        $('#vira-filters-form').trigger('change');
    });
});
