window.addEventListener("load", () => {

    let locations = [
        "Oude Baan 1H, 2800 Mechelen",
        "Grote Markt 21, 2800 Mechelen",
        "Mechelbaan 547, 2580 Putte",
        "Twaalf Apostelenstraat 17, 2800 Mechelen",
        "Korte Schipstraat 16, 2800 Mechelen",
        "Sint Romboutskerkhof 1, 2800 Mechelen",
        "Stationsstraat 22, 2800 Mechelen",
        "Steenweg op Heindonck 103, 2801 Heffen"
    ];

    let locationsOrdered = [];

    const key = "FUfuvyGPy9tbvsWsNS9ReZwR5qJvzhn0";

    let json = {
        "locations": locations
    };

    json = JSON.stringify(json);

    let url = `http://www.mapquestapi.com/directions/v2/optimizedroute?key=${key}&json=${json}`;

    
    fetch(url)
        .then(response => response.json())
        .then(data => {
            let locationSequence = data.route.locationSequence;

            for(let i = 0; i < locationSequence.length; i++) {
                let index = locationSequence[i];
                locationsOrdered.push(locations[index]);
            }

            console.log(locationsOrdered);
        });

});