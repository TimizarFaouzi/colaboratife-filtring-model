/*
 Template Name: Jassa - Responsive Bootstrap 4 Admin Dashboard
 Author: Therichpost
 File: Dashboard Init
 */

 setTimeout(function(){
    !function ($) {
      "use strict";
    
      var Dashboard = function () {
      };
    
          //creates area chart
          Dashboard.prototype.createAreaChart = function (element, pointSize, lineWidth, data, xkey, ykeys, labels, lineColors) {
              Morris.Area({
                  element: element,
                  pointSize: 0,
                  lineWidth: 0,
                  data: data,
                  xkey: xkey,
                  ykeys: ykeys,
                  labels: labels,
                  resize: true,
                  gridLineColor: '#2a2c44',
                  hideHover: 'auto',
                  lineColors: lineColors,
                  fillOpacity: .9,
                  behaveLikeLine: true
              });
          },
    
          //creates Donut chart
          Dashboard.prototype.createDonutChart = function (element, data, colors) {
              Morris.Donut({
                  element: element,
                  data: data,
                  resize: true,
                  labelColor: '#a5a6ad',
                backgroundColor: '#222437',
                  colors: colors
              });
          },
              //creates line chart Dark
        Dashboard.prototype.createLineChart1 = function(element, data, xkey, ykeys, labels, lineColors) {
          Morris.Line({
              element: element,
              data: data,
              xkey: xkey,
              ykeys: ykeys,
              labels: labels,
              gridLineColor: '#2a2c44',
              hideHover: 'auto',
              pointSize: 3,
              resize: true, //defaulted to true
              lineColors: lineColors
          });
      },
    
    
          Dashboard.prototype.init = function () {
            fetch("/line-graph"+$('#user_id').val()).then(response=>response.json()).then(data=>{
             // $('.add-Cart').append('')
             $('.active-card').html('<h3 class="mt-4">'+data.activMarker+'</h3>'+
             '<div class="progress mt-4" style="height: 4px;">'+
                ' <div class="progress-bar bg-primary" role="progressbar" style="width:'+data.PAM+'%" aria-valuenow="'+data.PAM+'" aria-valuemin="0" aria-valuemax="100"></div>'+
             '</div>'+
             '<p class="text-muted mt-2 mb-0">Previous period<span class="float-right">'+data.PAM+'%</span></p>')

             $('.total-card').html('<h3 class="mt-4">'+data.totoMarker+'</h3>'+
             '<div class="progress mt-4" style="height: 4px;">'+
                 '<div class="progress-bar bg-success" role="progressbar" style="width: '+data.PAM+'%" aria-valuenow="'+data.PAM+'" aria-valuemin="0" aria-valuemax="100"></div>'+
             '</div>'+
            ' <p class="text-muted mt-2 mb-0">Previous period<span class="float-right">'+data.PAM+'%</span></p>'+
             '</div>')


              $('.nb-vi').html('<h3 class="mt-4">'+data.users_nb_vi+'</h3>'+
              '<div class="progress mt-4" style="height: 4px;">'+
                  '<div class="progress-bar bg-warning" role="progressbar" style="width:'+data.prosontageViusr+'%" aria-valuenow="'+data.prosontageViusr+'" aria-valuemin="0" aria-valuemax="100"></div>'+
             ' </div>'+
              '<p class="text-muted mt-2 mb-0">Previous period<span class="float-right">'+data.prosontageViusr+'%</span></p>')
             //prosntage  Add POI tis user
              $('.add-Cart').html('<h3 class="mt-4">'+data.PercentageAddMarkers+' %</h3>'+
              '<div class="progress mt-4" style="height: 4px;">'+
                 ' <div class="progress-bar bg-danger" role="progressbar" style="width:'+data.PercentageAddMarkers+'%" aria-valuenow="'+data.PercentageAddMarkers+'" aria-valuemin="0" aria-valuemax="100"></div>'+
              '</div>'+
             '<p class="text-muted mt-2 mb-0">Previous period<span class="float-right">'+data.PercentageAddMarkers+'%</span></p>')


            // Graph  Bakground system rocomndation total     
             this.createAreaChart('morris-area-example', 0, 0,data.dataPoints, 'date', ['SRA', 'SRB'], ['SR Algorithem Pearson', 'Algorithem Slop One'], [ '#02c58d', '#30419b']);//, '#30419b'

             
             // surcl system rocomndation number de click  Totale 
             var $donutData = [
                {label: "Number de user Rating SR Pearsonn", value: data.countper},
                {label: "Number de user Rating SR Slop ONE", value: data.countslp},
                //{label: "Mail-Order Sales", value: 40}
            ];
            this.createDonutChart('morris-donut-example', $donutData, ['#02c58d', '#30419b']);//, '#fcbe2d'

             //Graph system rocomndation par line chaque user
             this.createLineChart1('morris-line-examplesr',data.dataPointsUser,'date', ['SRA', 'SRB'], ['SR Algorithem Pearson', 'Algorithem Slop One'],['#02c58d', '#30419b']);
             
             //Graph Bakground system rocomndation par  chaque user
             this.createAreaChart('pg-sr-user', 0, 0,data.dataPointsUser, 'date', ['SRA', 'SRB'], ['SR Algorithem Pearson', 'Algorithem Slop One'], [ '#02c58d', '#30419b']);//, '#30419b'
             
             // surcl system rocomndation number de click  par chaque user cr-sr-user
             var $donutData1 = [
                {label: "Number de user Rating SR Pearsonn", value: $('#sra').val()},
                {label: "Number de user Rating SR Slop ONE", value: $('#srb').val()},
                //{label: "Mail-Order Sales", value: 40}
            ];
            this.createDonutChart('cr-sr-user', $donutData1, ['#02c58d', '#30419b']);//, '#02c58d'

            
          this.createLineChart1('morris-line-example',data.dataPoints,'date', ['SRA', 'SRB'], ['SR Algorithem Pearson', 'Algorithem Slop One'],['#02c58d', '#30419b']);
    
            })
            //var $areaDatahh=[$markerroc];
              //creating area chart
             /* var areaData= [
                  {"y" : '2013', "a" : 0, "b" : 0, "c" :0},
                  {"y" : '2014', "a" : 150, "b" : 45, "c" :15},
                  {"y" : '2015', "a" : 60, "b" : 150, "c" :220},
                  {"y" : '2016', "a" : 180, "b" : 36, "c" :21},
                  {"y" : '2017', "a" : 90, "b" : 60, "c" :360},
                  {"y" : '2018', "a" : 75, "b" : 240, "c" :120},
                  {"y" : '2019', "a" : 30, "b" : 30, "c" :30},
                  {"y" : '2020', "a" : 30, "b" : 30, "c" :30}
              ];*/
            // this.createAreaChart('morris-area-example', 0, 0,areaData, 'y', ['a', 'b', 'c'], ['Series A', 'Series B', 'Series C'], ['#fcbe2d', '#02c58d', '#30419b']);
    
              //creating donut chart
         
                      //create line chart Dark
            var $data1  = [
              { y: '2009', a: 20, b: 5 },
              { y: '2010', a: 45,  b: 35 },
              { y: '2011', a: 50,  b: 40 },
              { y: '2012', a: 75,  b: 65 },
              { y: '2013', a: 50,  b: 40 },
              { y: '2014', a: 75,  b: 65 },
              { y: '2015', a: 100, b: 90 }
          ];
         // this.createLineChart1('morris-line-example', $data1, 'y', ['a', 'b'], ['Series A', 'Series B'], ['#30419b', '#02c58d']);
    
    
    
          },
          //init
          $.Dashboard = new Dashboard, $.Dashboard.Constructor = Dashboard
    }(window.jQuery),
    
    //initializing 
      function ($) {
          "use strict";
          $.Dashboard.init();
      }(window.jQuery);
    }, 1000);

    