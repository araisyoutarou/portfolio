<!DOCTYPE html>
<html lang="ja">

   <head>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">

       <title>Laravel</title>
   </head>

   <body>
       <div class="content">
           <canvas id="allChart"></canvas>
       </div>

       <script src="{{ mix('js/show_chart.js') }}"></script>
       <script>
           id = 'allChart';
           labels = @json($keys);
           data = @json($counts);
           make_chart(id,labels,data);
       </script>
   </body>

</html>