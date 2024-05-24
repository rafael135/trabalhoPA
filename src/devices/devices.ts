//import { route } from "ziggy-js";
//import { AxiosAdapter } from "axios";

const updateDeviceModalBtnClose = document.getElementById("updateDeviceModalBtnClose") as HTMLButtonElement;
const addDeviceModalBtnClose = document.getElementById("addDeviceModalBtnClose") as HTMLButtonElement;

let itemsPerPage = 8;
let currentPage = 1;
let totalPages = 1;

let paginationPreviousBtn = document.querySelector("a#paginationPrevious") as HTMLAnchorElement;
let paginationBtn1 = document.querySelector("a#paginationBtn1") as HTMLAnchorElement;
let paginationBtn2 = document.querySelector("a#paginationBtn2") as HTMLAnchorElement;
let paginationBtn3 = document.querySelector("a#paginationBtn3") as HTMLAnchorElement;
let paginationNextBtn = document.querySelector("a#paginationNext") as HTMLAnchorElement;

let activePagination: HTMLElement = paginationBtn1;

let paginationPageInput = document.querySelector("input#currentPageInput") as HTMLInputElement;
let paginationTotalPages = document.querySelector("span#totalPages") as HTMLSpanElement;

const devicesLoadingStatus = document.querySelector("div.device-status") as HTMLDivElement;



const formAddDevice = document.querySelector("form#formAddDevice") as HTMLFormElement;
const addRememberTokenInput = formAddDevice.querySelector("input#rememberToken") as HTMLInputElement;
const addInputBrand = formAddDevice.querySelector("input#brand") as HTMLInputElement;
const addInputName = formAddDevice.querySelector("input#name") as HTMLInputElement;
const addInputConsumptionPerHour = formAddDevice.querySelector("input#consumptionPerHour") as HTMLInputElement;
const addInputHoursPerDay = formAddDevice.querySelector("input#hoursPerDay") as HTMLInputElement;

const formUpdateDevice = document.querySelector("form#formUpdateDevice") as HTMLFormElement;
const updateRememberTokenInput = formUpdateDevice.querySelector("input#rememberToken") as HTMLInputElement;
const updateInputBrand = formUpdateDevice.querySelector("input#brand") as HTMLInputElement;
const updateInputName = formUpdateDevice.querySelector("input#name") as HTMLInputElement;
const updateInputConsumptionPerHour = formUpdateDevice.querySelector("input#consumptionPerHour") as HTMLInputElement;
const updateInputHoursPerDay = formUpdateDevice.querySelector("input#hoursPerDay") as HTMLInputElement;

let selectedRowToUpdate: HTMLDivElement;
let selectedDeviceId: number = 0;

const updateDeviceBtn = document.querySelector("button#updateDeviceBtn") as HTMLButtonElement;

const updateModalStatus = document.querySelector("div#updateModalStatus") as HTMLDivElement;


let devicesBody = document.querySelector("div#devices-body") as HTMLDivElement;
let devices: NodeListOf<HTMLDivElement>;
const deviceRowTemplate = devicesBody.querySelector("div#device-template") as HTMLDivElement;

let devicesBtns: NodeListOf<HTMLSpanElement>;

const updateBtns = () => {
    devicesBtns = devicesBody.querySelectorAll("span");

    devicesBtns.forEach((btn) => {
        btn.addEventListener("click", (e) => viewDevice(e));
    });

}

type Device = {
    id: number;
    user_id: number;
    brand: string;
    name: string;
    consumption_per_hour: number;
    hours_per_day: number;
    created_at: string;
    updated_at: string;
};

addInputHoursPerDay.addEventListener("change", (e) => {
    if (Number.parseInt(addInputHoursPerDay.value) > 24) {
        addInputHoursPerDay.value = "24";
    } else if (Number.parseInt(addInputHoursPerDay.value) < 1) {
        addInputHoursPerDay.value = "1";
    }
});

updateInputHoursPerDay.addEventListener("change", (e) => {
    if (Number.parseInt(updateInputHoursPerDay.value) > 24) {
        updateInputHoursPerDay.value = "24";
    } else if (Number.parseInt(updateInputHoursPerDay.value) < 1) {
        updateInputHoursPerDay.value = "1";
    }
});

type GetDevicesResponse = {
    devices: Device[];
    pages: number;
    status: number;
};

const getDevices = async () => {
    paginationPageInput.value = `${currentPage}`;

    devices = devicesBody.querySelectorAll("div.device-item") as NodeListOf<HTMLDivElement>;

    if (devices != undefined && devices.length > 0) {
        devices.forEach((device, idx) => {
            if (idx != 0) {
                device.remove();
            }

        });
    }

    devicesLoadingStatus.classList.add("loading");


    // @ts-expect-error
    let req = await fetch(`${route("api.getDevices")}?page=${currentPage}&itemsPerPage=${itemsPerPage}&searchTerm=`, {
        method: "GET",
        headers: {
            Authorization: updateRememberTokenInput.value
        }
    });

    let res: GetDevicesResponse = await req.json();

    if (res.status == 200) {
        totalPages = res.pages;
        paginationPageInput.setAttribute("max", `${totalPages}`);
        paginationTotalPages.textContent = `${totalPages}`;

        if (totalPages < currentPage) {
            currentPage = 1;
        }

        await validatePagination();

        res.devices.forEach((device) => {
            addDeviceToDevicesBody(device);
        });
    }

    devicesLoadingStatus.classList.remove("loading");

    updateBtns();
}

const updateSelectedRow = (device: Device) => {
    let updatedBrand = selectedRowToUpdate.querySelector("div.device-brand") as HTMLDivElement;
    let updatedName = selectedRowToUpdate.querySelector("div.device-name") as HTMLDivElement;
    let updatedConsumptionPerHour = selectedRowToUpdate.querySelector("div.device-consumptionPerHour") as HTMLDivElement;
    let updatedHoursPerDay = selectedRowToUpdate.querySelector("div.device-hoursPerDay") as HTMLDivElement;

    updatedBrand.innerText = device.brand;
    updatedName.innerText = device.name;
    updatedConsumptionPerHour.innerText = device.consumption_per_hour.toString();
    updatedHoursPerDay.innerText = device.hours_per_day.toString();

    updateDeviceModalBtnClose.click();
}


const addDeviceToDevicesBody = (device: Device) => {

    let newRow = deviceRowTemplate.cloneNode(true) as HTMLDivElement;

    let newBrand = newRow.querySelector("div#item-brand") as HTMLDivElement;
    newBrand.id = "";
    let newName = newRow.querySelector("div#item-name") as HTMLDivElement;
    newName.id = "";
    let newConsumptionPerHour = newRow.querySelector("div#item-consumptionPerHour") as HTMLDivElement;
    newConsumptionPerHour.id = "";
    let newHoursPerDay = newRow.querySelector("div#item-hoursPerDay") as HTMLDivElement;
    newHoursPerDay.id = "";
    let newDeviceActions = newRow.querySelector("div#device-actions") as HTMLDivElement;
    newDeviceActions.id = "";
    let newViewDeviceBtn = newDeviceActions.querySelector("span") as HTMLSpanElement;


    newBrand.innerText = device.brand;
    newName.innerText = device.name;
    newConsumptionPerHour.innerText = device.consumption_per_hour.toString();
    newHoursPerDay.innerText = device.hours_per_day.toString();
    newViewDeviceBtn.setAttribute("data-id", device.id.toString());

    newRow.id = "";

    devicesBody.appendChild(newRow);
}

type CreateDeviceResponse = {
    device: Device;
    status: number;
};

formAddDevice.addEventListener("submit", async (e) => {
    e.preventDefault();

    let rememberToken = addRememberTokenInput.value;
    let brand = addInputBrand.value;
    let name = addInputName.value;
    let consumptionPerHour = Number.parseInt(addInputConsumptionPerHour.value);
    let hoursPerDay = Number.parseInt(addInputHoursPerDay.value);

    if (rememberToken == "" || brand == "" || name == "" || consumptionPerHour == null || consumptionPerHour == 0 || hoursPerDay == null) {
        return;
    }

    // @ts-expect-error
    let req = await fetch(route("api.createDevice"), {
        method: "POST",
        headers: {
            Authorization: rememberToken,
            "Content-Type": "application/json",
            Accept: "application/json"
        },
        body: JSON.stringify({
            brand: brand,
            name: name,
            consumptionPerHour: consumptionPerHour,
            hoursPerDay: hoursPerDay
        })
    });

    let res: CreateDeviceResponse = await req.json();

    if (req.status == 201) {
        await getDevices();
        updateBtns();
        addDeviceModalBtnClose.click();
    }
});


type UpdateDeviceResponse = {
    device: Device;
    status: number;
}

formUpdateDevice.addEventListener("submit", async (e) => {
    e.preventDefault();

    let rememberToken = updateRememberTokenInput.value;
    let brand = updateInputBrand.value;
    let name = updateInputName.value;
    let consumptionPerHour = Number.parseInt(updateInputConsumptionPerHour.value);
    let hoursPerDay = Number.parseInt(updateInputHoursPerDay.value);

    // @ts-expect-error
    let req = await fetch(route("api.updateDevice", { id: selectedDeviceId }), {
        method: "PUT",
        headers: {
            Authorization: rememberToken,
            "Content-Type": "application/json",
            Accept: "application/json"
        },
        body: JSON.stringify({
            brand: brand,
            name: name,
            consumptionPerHour: consumptionPerHour,
            hoursPerDay: hoursPerDay
        })
    });

    let res: UpdateDeviceResponse = await req.json();

    if(req.status == 200) {
        updateSelectedRow(res.device);
    }
});

type GetDeviceResponse = {
    device: Device;
    status: number;
}



const viewDevice = async (e: MouseEvent) => {
    updateInputBrand.value = "";
    updateInputName.value = "";
    updateInputConsumptionPerHour.value = "";
    updateInputHoursPerDay.value = "";

    updateModalStatus.classList.add("loading");
    updateDeviceBtn.click();

    let deviceId = (e.target! as HTMLSpanElement).parentElement!.getAttribute("data-id");

    // @ts-expect-error
    let req = await fetch(route("api.getDevice", { id: deviceId }), {
        method: "GET",
        headers: {
            Authorization: updateRememberTokenInput.value
        }
    });

    let res: GetDeviceResponse = await req.json();

    if (res.status == 200) {
        updateInputBrand.value = res.device.brand;
        updateInputName.value = res.device.name;
        updateInputConsumptionPerHour.value = res.device.consumption_per_hour.toString();
        updateInputHoursPerDay.value = res.device.hours_per_day.toString();

        selectedRowToUpdate = (e.target! as HTMLSpanElement).parentElement!.parentElement!.parentElement! as HTMLDivElement;
        selectedDeviceId = Number.parseInt(deviceId!);
        //updateBtns();
    }

    updateModalStatus.classList.remove("loading");
}

paginationPreviousBtn.addEventListener("click", (e) => {
    e.preventDefault();

    if (currentPage - 1 > 0) {
        currentPage--;
        getDevices();
    }

});
paginationBtn1.addEventListener("click", (e) => {
    e.preventDefault();

    let page = parseInt(paginationBtn1.getAttribute("data-page") as string);

    if (page <= totalPages) {
        activePagination!.parentElement!.classList.remove("active");
        paginationBtn1.parentElement!.classList.add("active");

        activePagination = paginationBtn1;
        currentPage = page;
        getDevices();
    }

});
paginationBtn2.addEventListener("click", (e) => {
    e.preventDefault();

    let page = parseInt(paginationBtn2.getAttribute("data-page") as string);

    if (page <= totalPages) {
        activePagination!.parentElement!.classList.remove("active");
        paginationBtn2.parentElement!.classList.add("active");

        activePagination = paginationBtn2;
        currentPage = page;
        getDevices();
    }

});
paginationBtn3.addEventListener("click", (e) => {
    e.preventDefault();

    let page = parseInt(paginationBtn3.getAttribute("data-page") as string);

    if (page <= totalPages) {
        activePagination!.parentElement!.classList.remove("active");
        paginationBtn3.parentElement!.classList.add("active");

        activePagination = paginationBtn3;
        currentPage = page;
        getDevices();
    }
});
paginationNextBtn.addEventListener("click", (e) => {
    e.preventDefault();
    if (currentPage + 1 <= totalPages) {
        currentPage++;
        getDevices();
    }
});

paginationPageInput.addEventListener("change", (e) => {
    let page = parseInt(paginationPageInput.value);

    if (page <= 0 || page > totalPages) {
        return;
    }
    currentPage = page;
    getDevices();
})

const validatePagination = async () => {
    if (totalPages >= 3) {
        if (currentPage < 2) {
            paginationPreviousBtn.parentElement!.classList.add("disabled");
        } else {
            paginationPreviousBtn.parentElement!.classList.remove("disabled");
        }

        let btn1Page = `${((currentPage == 1) ? currentPage : currentPage - 1)}`;

        paginationBtn1.setAttribute("data-page", btn1Page);
        paginationBtn1.innerText = btn1Page;

        (currentPage >= 1) ? paginationBtn1.parentElement!.classList.remove("disabled") : paginationBtn1.parentElement!.classList.add("disabled");
        (currentPage != 1) ? paginationBtn1.parentElement!.classList.remove("active") : paginationBtn1.parentElement!.classList.add("active");

        let btn2Page = `${((currentPage >= 2) ? currentPage : currentPage + 1)}`;

        paginationBtn2.setAttribute("data-page", btn2Page);
        paginationBtn2.innerText = btn2Page;

        (currentPage >= 1) ? paginationBtn2.parentElement!.classList.remove("disabled") : paginationBtn2.parentElement!.classList.add("disabled");
        (currentPage == parseInt(btn2Page)) ? paginationBtn2.parentElement!.classList.add("active") : paginationBtn2.parentElement!.classList.remove("active");

        let btn3Page = '';

        if (currentPage == 1) {
            btn3Page = `${currentPage + 2}`;
        } else {
            btn3Page = `${currentPage + 1}`;
        }

        paginationBtn3.setAttribute("data-page", btn3Page);
        paginationBtn3.innerText = btn3Page;

        (currentPage >= 1) ? paginationBtn3.parentElement!.classList.remove("disabled") : paginationBtn3.parentElement!.classList.add("disabled");
        (currentPage == parseInt(btn3Page)) ? paginationBtn3.parentElement!.classList.add("active") : paginationBtn3.parentElement!.classList.remove("active");

        if (currentPage + 1 > totalPages) {
            paginationNextBtn.parentElement!.classList.add("disabled");
            (currentPage == totalPages) ? paginationBtn3.parentElement!.classList.add("disabled") : paginationBtn3.parentElement!.classList.remove("disabled");
        } else {
            paginationNextBtn.parentElement!.classList.remove("disabled");
        }
    } else {
        paginationBtn1.setAttribute("data-page", "1");
        paginationBtn1.innerText = "1";

        paginationBtn2.setAttribute("data-page", "2");
        paginationBtn2.innerText = "2";

        paginationBtn3.setAttribute("data-page", "3");
        paginationBtn3.innerText = "3";

        if (currentPage == 1) {
            paginationPreviousBtn.parentElement!.classList.add("disabled");
            paginationBtn1.parentElement!.classList.remove("disabled");
            paginationBtn1.parentElement!.classList.add("active");

            (totalPages == 2) ? paginationBtn2.parentElement!.classList.remove("disabled") : paginationBtn2.parentElement!.classList.add("disabled");
        } else {
            paginationPreviousBtn.parentElement!.classList.remove("disabled");
            paginationBtn1.parentElement!.classList.remove("active");

            (totalPages == 2) ? paginationNextBtn.parentElement!.classList.remove("disabled") : paginationNextBtn.parentElement!.classList.add("disabled");
        }

        if (currentPage == 2) {
            paginationBtn2.parentElement!.classList.remove("disabled");
            paginationBtn2.parentElement!.classList.add("active");
        } else {
            paginationBtn2.parentElement!.classList.remove("active");
        }

        if (currentPage == totalPages) {
            paginationNextBtn.parentElement!.classList.add("disabled");
        } else {
            paginationNextBtn.parentElement!.classList.remove("disabled");
        }

        (totalPages < 3) ? paginationBtn3.parentElement!.classList.add("disabled") : paginationBtn3.parentElement!.classList.remove("disabled");
        (totalPages < 3) ? paginationNextBtn.parentElement!.classList.add("disabled") : paginationNextBtn.parentElement!.classList.remove("disabled");
    }
}


document.addEventListener("DOMContentLoaded", (e) => {
    setTimeout(() => {
        getDevices();
    }, 200);
    
});
