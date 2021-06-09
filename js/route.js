window.addEventListener("load", () => {

    const key = "FUfuvyGPy9tbvsWsNS9ReZwR5qJvzhn0";

    const foodsaversAddress = {
        id: "NULL",
        name: "Foodsavers",
        address_street: "Oude Baan",
        address_number: "1H",
        postal_code: "2800",
        city: "Mechelen"
    };

    let stops;
    let stopsOrdered = [];

    let locations = [];

    fetch("https://www.bobstorms.be/foodflow/get-stops.php")
        .then(response => response.json())
        .then(json => {
            stops = json.data;

            stops.unshift(foodsaversAddress);
            stops.push(foodsaversAddress);
            
            console.log(stops);

            stops.forEach(element => {
                let address = element.address_street + " " + element.address_number + ", " + element.postal_code + " " + element.city;
                console.log(address);
                locations.push(address);
            });

            let jsonLocations = {
                "locations": locations
            };
            jsonLocations = JSON.stringify(jsonLocations);

            let url = `http://www.mapquestapi.com/directions/v2/optimizedroute?key=${key}&json=${jsonLocations}`;

            fetch(url)
            .then(response => response.json())
            .then(json => {
                let locationSequence = json.route.locationSequence;
    
                for(let i = 0; i < locationSequence.length; i++) {
                    let index = locationSequence[i];
                    stopsOrdered.push(stops[index]);
                }
    
                console.log(stopsOrdered);
            });

        });

});