/*=========================================================================================
    DataFlow - Anexys (Big Data Consulting)
==========================================================================================*/

$(window).on("load", function () {

  var $Commandes_color = '#084a4e';
  var $Factures_color = '#2CD4B1';
  var $Desadv_color = '#000';
  var $siege_color = '#084a4e';
  var $societe_color = '#2CD4B1';
  var $partner_color = '#000';
  var $siege_color_light = '#95B1B3';
  var $societe_color_light = '#CBF4EC';
  var $partner_color_light = '#BCBCBC';
  
  var $users1_color = '#2CD4B1';
  var $users1_color_light = '#CBF4EC';

  var $users2_color = '#EA5455';
  var $users2_color_light = '#f29292';

  var $primary = '#084a4e';
  var $danger = '#EA5455';
  var $warning = '#FF9F43';
  var $info = '#0DCCE1';
  var $primary_light = '#8F80F9';
  var $warning_light = '#FFC085';
  var $danger_light = '#f29292';
  var $info_light = '#1edec5';
  var $strok_color = '#b9c3cd';
  var $label_color = '#e7eef7';
  var $white = '#fff';


  // Commandes Chart starts //
  // ----------------------------------
  var CommandesChartoptions = {
    chart: {
      height: 100,
      type: 'area',
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true
      },
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      },
    },
    colors: [$Commandes_color],
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 2.5
    },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 0.9,
        opacityFrom: 0.7,
        opacityTo: 0.5,
        stops: [0, 80, 100]
      }
    },
    series: [{
      name: 'Commandes',
      data: [28, 40, 36, 52, 38, 60, 55]
    }],

    xaxis: {
      labels: {
        show: false,
      },
      axisBorder: {
        show: false,
      }
    },
    yaxis: [{
      y: 0,
      offsetX: 0,
      offsetY: 0,
      padding: { left: 0, right: 0 },
    }],
    tooltip: {
      x: { show: false }
    },
  }

  var CommandesChart = new ApexCharts(
    document.querySelector("#CommandesChart-area"),
    CommandesChartoptions
  );

  CommandesChart.render();

  // Commandes Chart ends //



  // Factures Chart starts //
  // ----------------------------------

  var FacturesChartoptions = {
    chart: {
      height: 100,
      type: 'area',
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true
      },
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      },
    },
    colors: [$Factures_color],
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 2.5
    },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 0.9,
        opacityFrom: 0.7,
        opacityTo: 0.5,
        stops: [0, 80, 100]
      }
    },
    series: [{
      name: 'Factures',
      data: [10, 15, 8, 15, 7, 12, 8]
    }],

    xaxis: {
      labels: {
        show: false,
      },
      axisBorder: {
        show: false,
      }
    },
    yaxis: [{
      y: 0,
      offsetX: 0,
      offsetY: 0,
      padding: { left: 0, right: 0 },
    }],
    tooltip: {
      x: { show: false }
    },
  }

  var FacturesChart = new ApexCharts(
    document.querySelector("#FacturesChart-area"),
    FacturesChartoptions
  );

  FacturesChart.render();

  // Factures Chart ends //


  // Desadv Chart starts //
  // ----------------------------------

  var DesadvChartoptions = {
    chart: {
      height: 100,
      type: 'area',
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true
      },
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      },
    },
    colors: [$Desadv_color],
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 2.5
    },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 0.9,
        opacityFrom: 0.7,
        opacityTo: 0.5,
        stops: [0, 80, 100]
      }
    },
    series: [{
      name: 'Desadv',
      data: [10, 15, 8, 15, 7, 12, 8]
    }],

    xaxis: {
      labels: {
        show: false,
      },
      axisBorder: {
        show: false,
      }
    },
    yaxis: [{
      y: 0,
      offsetX: 0,
      offsetY: 0,
      padding: { left: 0, right: 0 },
    }],
    tooltip: {
      x: { show: false }
    },
  }

  var DesadvChart = new ApexCharts(
    document.querySelector("#DesadvChart-area"),
    DesadvChartoptions
  );

  DesadvChart.render();

  // Factures Chart ends //

  // Entreprises Chart starts
  // -----------------------------

  var EntreprisesChartoptions = {
    chart: {
      height: 325,
      type: 'radialBar',
    },
    colors: [$siege_color, $societe_color, $partner_color],
    fill: {
      type: 'gradient',
      gradient: {
        // enabled: true,
        shade: 'dark',
        type: 'vertical',
        shadeIntensity: 0.5,
        gradientToColors: [$siege_color_light, $societe_color_light, $partner_color_light],
        inverseColors: false,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 100]
      },
    },
    stroke: {
      lineCap: 'round'
    },
    plotOptions: {
      radialBar: {
        size: 165,
        hollow: {
          size: '20%'
        },
        track: {
          strokeWidth: '100%',
          margin: 15,
        },
        dataLabels: {
          name: {
            fontSize: '18px',
          },
          value: {
            fontSize: '16px',
          },
          total: {
            show: true,
            label: 'Total',

            formatter: function (w) {
              let TotalEntreprises= parseInt($('#mainCompaniesCount').html()) + parseInt($('#CompaniesCount').html()) + parseInt($('#PartnersCount').html())
              return TotalEntreprises
            }
          }
        }
      }
    },
    

    series: [$('#mainCompaniesCount').html(), $('#CompaniesCount').html(), $('#PartnersCount').html()],
    labels: ['Sièges', 'Sociétés', 'Partners'],

  }

  var EntreprisesChart = new ApexCharts(
    document.querySelector("#EntreprisesChart-area"),
    EntreprisesChartoptions
  );

  EntreprisesChart.render();

  // Entreprises Chart ends //


  
  // Users Chart starts
  // -----------------------------

  var UsersChartoptions = {
    chart: {
      height: 325,
      type: 'radialBar',
    },
    colors: [$users1_color,$users2_color],
    fill: {
      type: 'gradient',
      gradient: {
        // enabled: true,
        shade: 'dark',
        type: 'vertical',
        shadeIntensity: 0.5,
        gradientToColors: [$users1_color_light, $users2_color_light],
        inverseColors: false,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 100]
      },
    },
    stroke: {
      lineCap: 'round'
    },
    plotOptions: {
      radialBar: {
        size: 165,
        hollow: {
          size: '20%'
        },
        track: {
          strokeWidth: '100%',
          margin: 15,
        },
        dataLabels: {
          name: {
            fontSize: '18px',
          },
          value: {
            fontSize: '16px',
          },
          total: {
            show: true,
            label: 'Total',

            formatter: function (w) {
              let TotalUsers= parseInt($('#UsersActiveCount').html()) + parseInt($('#UsersDesactiveCount').html())
              return TotalUsers
            }
          }
        }
      }
    },
    series: [$('#UsersActiveCount').html(), $('#UsersDesactiveCount').html()],
    labels: ['Activé', 'Désactivé'],

  }
  
  var UsersChart = new ApexCharts(
    document.querySelector("#UsersChart-area"),
    UsersChartoptions
  );

  UsersChart.render();

  // Users Chart ends //


  if ($(window).width() > 1200 && !$("body").hasClass("menu-collapsed")) {
    // tour.start()
  }
  else {
    tour.cancel()
  }
  if ($("body").hasClass("horizontal-menu")) {
    tour.cancel()
  }
  $(window).on("resize", function () {
    tour.cancel()
  })

});
