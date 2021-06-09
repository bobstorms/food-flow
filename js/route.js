window.addEventListener("load", () => {

    const appendStart = (element) => {
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
    }

    const appendStop = (element) => {
        let stopDiv = document.createElement("div");
        stopDiv.classList = "route__stop";

        let iconDiv = document.createElement("div");
        iconDiv.classList = "route__stop__icon";

        let icon = document.createElement("img");
        let span = document.createElement("span");

        icon.src = "./images/route-stop-not-complete.svg";
        span.classList = "route__stop__icon__line";

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

    const appendDirectionsButton = (url) => {
        let button = document.createElement("a");
        button.target = "_blank";
        button.classList = "button button--secondary";
        button.innerText = "Toon routebeschrijving";
        button.href = url;
        buttonsDiv.append(button);
    }

    const appendArrivalButton = () => {
        let button = document.createElement("a");
        button.classList = "button button--primary";
        button.innerText = "Bevestig aankomst";
        button.href = "arrival.php";
        buttonsDiv.append(button);
    }

    let stops = JSON.parse(localStorage.getItem("stops"));

    let index;
    let indexFound = false;
    
    stops.forEach((element, i) => {
        if(element.is_ready === "0" && indexFound === false) {
            index = i;
            indexFound = true;
        }
    });

    const main = document.querySelector("main");

    const routeDiv = document.querySelector(".route");
    const loadingDiv = document.querySelector(".route__loading");

    let start = stops[index - 1];
    let stop = stops[index];

    loadingDiv.style.display = "none";
    appendStart(start);
    appendStop(stop);

    let buttonsDiv = document.createElement("div");
    buttonsDiv.classList = "route__buttons";

    let startLocation = start.address_street.replaceAll(" ", "+") + "+" + start.address_number + "+" + start.postal_code + "+" + start.city;
    let stopLocation = stop.address_street.replaceAll(" ", "+") + "+" + stop.address_number + "+" + stop.postal_code + "+" + stop.city;
    let directionsUrl = `https://www.google.com/maps/dir/?api=1&origin=${startLocation}&destination=${stopLocation}&travelmode=driving`;

    appendDirectionsButton(directionsUrl);
    appendArrivalButton();
    
    main.appendChild(buttonsDiv);

});