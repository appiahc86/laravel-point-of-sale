<script>

    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';


 @php
     $individual_pietotal = array();
$colors = array("#007bff", "#dc3545", "#ffc107", "#28a745", "#b52082",
 "#52102c", "#434039", "#09a296", "#14070c", "#501900", "#f87873", "rgba(69,99,125,0.97)", "rgba(227,201,201,0.64)",
 "rgba(175,0,175,0.64)");


  function get_total_of_piecategory($q){ //get total qty sale of a single category
      $total = \App\Order::where('category', $q)->sum('qty');
      return $total;
}

@endphp

    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {

            @php
                $piecategories = \App\Category::all(); //Get all categories
            @endphp

            labels: [

                @if(!empty($piecategories))
                    @foreach($piecategories as $piecategory)
                    "{{ $piecategory->name }}",    //Echo Category names into labels
                @php
                    $tt = get_total_of_piecategory($piecategory->name); // Pass category name into get_total_of_barcategory function
                     array_push($individual_pietotal, $tt);
                @endphp

                @endforeach
                @endif

            ],
            datasets: [{
                data: [

                    @foreach($individual_pietotal as $total)
                    {{ $total }},
                    @endforeach
                ],
                backgroundColor: [

                    @foreach($colors as $color)
                    "{{ $color }}",
                    @endforeach


                ],
            }],
        },
    });


</script>
