<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';


    @php

        $individual_bartotal = array();

    //Get max of all categories
       function get_max_of_all_barcategory(){
             $cat_array = array();
             $max_of_all_cat = array();

           $all_cat = \App\Category::all();
           foreach ($all_cat as $one_cat){
               array_push($cat_array, $one_cat->name);
           }

           foreach ($cat_array as $cat){
               $res = \App\Order::where('category', $cat)->sum('qty');
               array_push($max_of_all_cat, $res);
           }

           if(!empty($max_of_all_cat)){

               echo max($max_of_all_cat);
           }  else{
               echo '';
           }
           

  }


      function get_total_of_barcategory($q){ //get total qty sale of a single category
          $total = \App\Order::where('category', $q)->sum('qty');
          return $total;
  }
    @endphp


    // Bar Chart Example
    var ctx = document.getElementById("myBarChart");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            @php
             $barcategories = \App\Category::all(); //Get all categories
            @endphp

            labels: [

                @if(!empty($barcategories))
             @foreach($barcategories as $barcategory)
                "{{ $barcategory->name }}",    //Echo Category names into labels
                @php
                   $ww = get_total_of_barcategory($barcategory->name); // Pass category name into get_total_of_barcategory function
                    array_push($individual_bartotal, $ww);
                @endphp

                @endforeach
                @endif
            ],
            datasets: [{
                label: "Category",
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: [
                    //Print individual total qty here
                    @foreach($individual_bartotal as $total)
                    {{ $total }},
                    @endforeach
                ],
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 0
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 11
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: {{ get_max_of_all_barcategory() }},
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        display: true
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });


</script>
