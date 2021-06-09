window.addEventListener("load", () => {

    const key = "FUfuvyGPy9tbvsWsNS9ReZwR5qJvzhn0";

    const foodsaversAddress = {
        id: "NULL",
        name: "Foodsavers",
        address_street: "Oude Baan",
        address_number: "1H",
        postal_code: "2800",
        city: "Mechelen",
        is_ready: "0"
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
    
                appendAllStops(stopsOrdered);
            });

        });

    const appendAllStops = (stops) => {

        const routeDiv = document.querySelector(".route");

        stops.forEach((element, index) => {

            if(index === 0) {
                let stopDiv = document.createElement("div");
                stopDiv.classList = "route__stop";
    
                let iconDiv = document.createElement("div");
                iconDiv.classList = "route__stop__icon";
    
                let icon = document.createElement("img");
                icon.src = "./images/route-stop-complete.svg";    
                
                iconDiv.appendChild(icon);
    
                let infoDiv = document.createElement("div");
                infoDiv.classList = "route__stop__info";
    
                let spanName = document.createElement("span");
                spanName.classList = "route__stop__info__name";
                spanName.innerText = element.name;
    
                let spanAddress = document.createElement("span");
                spanAddress.classList = "route__stop__info__address";
                spanAddress.innerText = element.address_street + " " + element.address_number + ", " + element.postal_code + " " + element.city;
    
                infoDiv.appendChild(spanName);
                infoDiv.appendChild(spanAddress);
    
                stopDiv.appendChild(iconDiv);
                stopDiv.appendChild(infoDiv);
    
                routeDiv.appendChild(stopDiv);
            } else {
                let stopDiv = document.createElement("div");
                stopDiv.classList = "route__stop";
    
                let iconDiv = document.createElement("div");
                iconDiv.classList = "route__stop__icon";
    
                let icon = document.createElement("img");
                let span = document.createElement("span");
    
                if(element.is_ready === "0") {
                    icon.src = "./images/route-stop-not-complete.svg";
                    span.classList = "route__stop__icon__line";
                } else {
                    icon.src = "./images/route-stop-complete.svg";
                    span.classList = "route__stop__icon__line route__stop__icon__line--complete";
                }
    
                iconDiv.appendChild(icon);
                iconDiv.appendChild(span);
    
                let infoDiv = document.createElement("div");
                infoDiv.classList = "route__stop__info";
    
                let spanName = document.createElement("span");
                spanName.classList = "route__stop__info__name";
                spanName.innerText = element.name;
    
                let spanAddress = document.createElement("span");
                spanAddress.classList = "route__stop__info__address";
                spanAddress.innerText = element.address_street + " " + element.address_number + ", " + element.postal_code + " " + element.city;
    
                infoDiv.appendChild(spanName);
                infoDiv.appendChild(spanAddress);
    
                stopDiv.appendChild(iconDiv);
                stopDiv.appendChild(infoDiv);
    
                routeDiv.appendChild(stopDiv);
            }

        });

    }

});