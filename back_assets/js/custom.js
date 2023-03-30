$("#cabin_class_donut").length && Morris.Donut({
                element: "cabin_class_donut",
                data: [{
                    label: "Basic",
                    value: 10
                }, {
                    label: "Basic",
                    value: 60
                }, {
                    label: "Luxury",
                    value: 20
                }, {
                    label: "Master",
                    value: 10
                }],
                colors: ["#2979ff", "#34495E", "#ACADAC", "#3498DB"],
                formatter: function(t) {
                    return t + "%"
                },
                resize: !0
            })


$("#total_patient_monthly").length && Morris.Bar({
                element: "total_patient_monthly",
                data: [{
                    month: "January",
                    patient: 380
                }, {
                    month: "February",
                    patient: 655
                }, {
                    month: "March",
                    patient: 275
                }, {
                    month: "April",
                    patient: 1571
                }, {
                    month: "May",
                    patient: 655
                }, {
                    month: "June",
                    patient: 2154
                }, {
                    month: "July",
                    patient: 1144
                }, {
                    month: "August",
                    patient: 2371
                }, {
                    month: "September",
                    patient: 2154
                }, {
                    month: "October",
                    patient: 1144
                }, {
                    month: "November",
                    patient: 2371
                }, {
                    month: "December",
                    patient: 1471
                }],
                xkey: "month",
                ykeys: ["patient"],
                labels: ["Month"],
                barRatio: .4,
                barColors: ["#2979ff", "#34495E", "#ACADAC", "#3498DB"],
                xLabelAngle: 35,
                hideHover: "auto",
                resize: !0
            })


$("#total_patient_daily").length && Morris.Bar({
                element: "total_patient_daily",
                data: [{
                    day: "Day 1",
                    patient_num: 380
                }, {
                    day: "Day 2",
                    patient_num: 655
                }, {
                    day: "Day 3",
                    patient_num: 275
                }, {
                    day: "Day 4",
                    patient_num: 1571
                }, {
                    day: "Day 5",
                    patient_num: 655
                }, {
                    day: "Day 6",
                    patient_num: 2154
                }, {
                    day: "Day 7",
                    patient_num: 2154
                },{
                    day: "Day 8",
                    patient_num: 2154
                },{
                    day: "Day 9",
                    patient_num: 1144
                }, {
                    day: "Day 10",
                    patient_num: 2371
                }, {
                    day: "Day 11",
                    patient_num: 1471
                }, {
                    day: "Day 12",
                    patient_num: 1371
                }, {
                    day: "Day 13",
                    patient_num: 1471
                }, {
                    day: "Day 14",
                    patient_num: 1471
                },  {
                    day: "Day 15",
                    patient_num: 2371
                }, {
                    day: "Day 16",
                    patient_num: 1471
                }, {
                    day: "Day 17",
                    patient_num: 1371
                }, {
                    day: "Day 18",
                    patient_num: 1471
                }, {
                    day: "Day 19",
                    patient_num: 1471
                },  {
                    day: "Day 20",
                    patient_num: 2371
                }, {
                    day: "Day 21",
                    patient_num: 1471
                }, {
                    day: "Day 22",
                    patient_num: 1371
                }, {
                    day: "Day 23",
                    patient_num: 1471
                }, {
                    day: "Day 24",
                    patient_num: 1471
                },  {
                    day: "Day 25",
                    patient_num: 2371
                }, {
                    day: "Day 26",
                    patient_num: 1471
                }, {
                    day: "Day 27",
                    patient_num: 1371
                }, {
                    day: "Day 28",
                    patient_num: 1471
                }, {
                    day: "Day 29",
                    patient_num: 1471
                }, {
                    day: "Day 30",
                    patient_num: 1471
                }],
                xkey: "day",
                ykeys: ["patient_num"],
                labels: ["patient_num"],
                barRatio: .4,
                barColors: ["#2979ff", "#34495E", "#ACADAC", "#3498DB"],
                xLabelAngle: 35,
                hideHover: "auto",
                resize: !0
            })



