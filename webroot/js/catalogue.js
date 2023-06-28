var csrfToken = $('meta[name="csrfToken"]').attr('content');
// var Toast = Swal.mixin({
//     toast: true,
//     position: 'top-end',
//     showConfirmButton: false,
//     timer: 3000
// });

$(document).ready(function() {
    $('select').select2();
    $("[rel='tooltip']").tooltip();
    filterBrands();
});
function filterBrands() {
    if (document.getElementsByClassName("create-stockAlerts")) {
        $("#brand-id").on("select2:select", function (ev) {
            ev.preventDefault();
            var brand_val = $(ev.currentTarget).val();
            console.log(brand_val)
            $('#products_id').empty().select2({
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // this is defined in app.php as a js variable
                    },
                    url: '/ajax-filter-products',
                    dataType: "JSON",
                    data: {brand_id: brand_val},
                    method: "POST",
                    processResults: function (data) {
                        var results = [];
                        $.each(data, function (key, value) {
                            results.push({
                                id: key,
                                text: value,

                            });
                        });
                        console.log(results);

                        return {
                            results: results
                        };
                    }

                }
            });
        });
    }
}

