"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
const updateDeviceModalBtnClose = document.getElementById("updateDeviceModalBtnClose");
const addDeviceModalBtnClose = document.getElementById("addDeviceModalBtnClose");
let itemsPerPage = 8;
let currentPage = 1;
let totalPages = 1;
let paginationPreviousBtn = document.querySelector("a#paginationPrevious");
let paginationBtn1 = document.querySelector("a#paginationBtn1");
let paginationBtn2 = document.querySelector("a#paginationBtn2");
let paginationBtn3 = document.querySelector("a#paginationBtn3");
let paginationNextBtn = document.querySelector("a#paginationNext");
let activePagination = paginationBtn1;
let paginationPageInput = document.querySelector("input#currentPageInput");
let paginationTotalPages = document.querySelector("span#totalPages");
const devicesLoadingStatus = document.querySelector("div.device-status");
const createDeviceModalBtn = document.querySelector("button#createDeviceModalBtn");
const formAddDevice = document.querySelector("form#formAddDevice");
const addRememberTokenInput = formAddDevice.querySelector("input#rememberToken");
const addInputBrand = formAddDevice.querySelector("input#brand");
const addInputName = formAddDevice.querySelector("input#name");
const addInputConsumptionPerHour = formAddDevice.querySelector("input#consumptionPerHour");
const addInputHoursPerDay = formAddDevice.querySelector("input#hoursPerDay");
const formUpdateDevice = document.querySelector("form#formUpdateDevice");
const updateRememberTokenInput = formUpdateDevice.querySelector("input#rememberToken");
const updateInputBrand = formUpdateDevice.querySelector("input#brand");
const updateInputName = formUpdateDevice.querySelector("input#name");
const updateInputConsumptionPerHour = formUpdateDevice.querySelector("input#consumptionPerHour");
const updateInputHoursPerDay = formUpdateDevice.querySelector("input#hoursPerDay");
let selectedRowToUpdate;
let selectedDeviceId = 0;
const updateDeviceBtn = document.querySelector("button#updateDeviceBtn");
const deleteDeviceBtn = document.querySelector("button#deleteDeviceBtn");
const confirmDeviceDeleteBtn = document.querySelector("button#confirmDeviceDeleteBtn");
const updateModalStatus = document.querySelector("div#updateModalStatus");
let devicesBody = document.querySelector("div#devices-body");
let devices;
const deviceRowTemplate = devicesBody.querySelector("div#device-template");
let devicesViewsBtns;
let devicesDeleteBtns;
const updateBtns = () => {
    devicesViewsBtns = devicesBody.querySelectorAll("span.device-viewBtn");
    devicesDeleteBtns = devicesBody.querySelectorAll("span.device-deleteBtn");
    devicesViewsBtns.forEach((btn) => {
        btn.addEventListener("click", (e) => viewDevice(e));
    });
    devicesDeleteBtns.forEach((btn) => {
        btn.addEventListener("click", (e) => deleteDevice(e));
    });
};
createDeviceModalBtn.addEventListener("click", () => {
    addInputBrand.value = "";
    addInputName.value = "";
    addInputConsumptionPerHour.value = "";
    addInputHoursPerDay.value = "";
});
addInputHoursPerDay.addEventListener("change", (e) => {
    if (Number.parseInt(addInputHoursPerDay.value) > 24) {
        addInputHoursPerDay.value = "24";
    }
    else if (Number.parseInt(addInputHoursPerDay.value) < 1) {
        addInputHoursPerDay.value = "1";
    }
});
updateInputHoursPerDay.addEventListener("change", (e) => {
    if (Number.parseInt(updateInputHoursPerDay.value) > 24) {
        updateInputHoursPerDay.value = "24";
    }
    else if (Number.parseInt(updateInputHoursPerDay.value) < 1) {
        updateInputHoursPerDay.value = "1";
    }
});
const getDevices = () => __awaiter(void 0, void 0, void 0, function* () {
    paginationPageInput.value = `${currentPage}`;
    devices = devicesBody.querySelectorAll("div.device-item");
    if (devices != undefined && devices.length > 0) {
        devices.forEach((device, idx) => {
            if (idx != 0) {
                device.remove();
            }
        });
    }
    devicesLoadingStatus.classList.add("loading");
    let req = yield fetch(`${route("api.getDevices")}?page=${currentPage}&itemsPerPage=${itemsPerPage}&searchTerm=`, {
        method: "GET",
        headers: {
            Authorization: updateRememberTokenInput.value
        }
    });
    let res = yield req.json();
    if (res.status == 200) {
        totalPages = res.pages;
        paginationPageInput.setAttribute("max", `${totalPages}`);
        paginationTotalPages.textContent = `${totalPages}`;
        if (totalPages < currentPage) {
            currentPage = 1;
        }
        yield validatePagination();
        res.devices.forEach((device) => {
            addDeviceToDevicesBody(device);
        });
    }
    devicesLoadingStatus.classList.remove("loading");
    updateBtns();
});
const updateSelectedRow = (device) => {
    let updatedBrand = selectedRowToUpdate.querySelector("div.device-brand");
    let updatedName = selectedRowToUpdate.querySelector("div.device-name");
    let updatedConsumptionPerHour = selectedRowToUpdate.querySelector("div.device-consumptionPerHour");
    let updatedHoursPerDay = selectedRowToUpdate.querySelector("div.device-hoursPerDay");
    updatedBrand.innerText = device.brand;
    updatedName.innerText = device.name;
    updatedConsumptionPerHour.innerText = device.consumption_per_hour.toString();
    updatedHoursPerDay.innerText = device.hours_per_day.toString();
    updateDeviceModalBtnClose.click();
};
const addDeviceToDevicesBody = (device) => {
    let newRow = deviceRowTemplate.cloneNode(true);
    let newBrand = newRow.querySelector("div#item-brand");
    newBrand.id = "";
    let newName = newRow.querySelector("div#item-name");
    newName.id = "";
    let newConsumptionPerHour = newRow.querySelector("div#item-consumptionPerHour");
    newConsumptionPerHour.id = "";
    let newHoursPerDay = newRow.querySelector("div#item-hoursPerDay");
    newHoursPerDay.id = "";
    let newDeviceActions = newRow.querySelector("div#device-actions");
    newDeviceActions.id = "";
    let newViewDeviceBtn = newDeviceActions.querySelector("span.device-viewBtn");
    let newDeleteDeviceBtn = newDeviceActions.querySelector("span.device-deleteBtn");
    newBrand.innerText = device.brand;
    newName.innerText = device.name;
    newConsumptionPerHour.innerText = `${device.consumption_per_hour.toString()} W`;
    newHoursPerDay.innerText = `${device.hours_per_day.toString()} h`;
    newViewDeviceBtn.setAttribute("data-id", device.id.toString());
    newDeleteDeviceBtn.setAttribute("data-id", device.id.toString());
    newRow.id = "";
    devicesBody.appendChild(newRow);
};
const deleteDevice = (e) => {
    let deviceId = e.currentTarget.getAttribute("data-id");
    selectedDeviceId = Number.parseInt(deviceId);
    deleteDeviceBtn.click();
};
const confirmDeviceDelete = () => __awaiter(void 0, void 0, void 0, function* () {
    let rememberToken = addRememberTokenInput.value;
    let req = yield fetch(route("api.deleteDevice", { id: selectedDeviceId }), {
        method: "DELETE",
        headers: {
            Authorization: rememberToken
        },
        credentials: "omit"
    });
    let res = yield req.json();
    if (res.status == 200) {
        getDevices();
    }
    deleteDeviceBtn.click();
});
confirmDeviceDeleteBtn.addEventListener("click", confirmDeviceDelete);
formAddDevice.addEventListener("submit", (e) => __awaiter(void 0, void 0, void 0, function* () {
    e.preventDefault();
    let rememberToken = addRememberTokenInput.value;
    let brand = addInputBrand.value;
    let name = addInputName.value;
    let consumptionPerHour = Number.parseInt(addInputConsumptionPerHour.value);
    let hoursPerDay = Number.parseInt(addInputHoursPerDay.value);
    if (rememberToken == "" || brand == "" || name == "" || consumptionPerHour == null || consumptionPerHour == 0 || hoursPerDay == null) {
        return;
    }
    let req = yield fetch(route("api.createDevice"), {
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
    let res = yield req.json();
    if (req.status == 201) {
        yield getDevices();
        updateBtns();
        addDeviceModalBtnClose.click();
    }
}));
formUpdateDevice.addEventListener("submit", (e) => __awaiter(void 0, void 0, void 0, function* () {
    e.preventDefault();
    let rememberToken = updateRememberTokenInput.value;
    let brand = updateInputBrand.value;
    let name = updateInputName.value;
    let consumptionPerHour = Number.parseInt(updateInputConsumptionPerHour.value);
    let hoursPerDay = Number.parseInt(updateInputHoursPerDay.value);
    let req = yield fetch(route("api.updateDevice", { id: selectedDeviceId }), {
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
    let res = yield req.json();
    if (req.status == 200) {
        updateSelectedRow(res.device);
    }
}));
const viewDevice = (e) => __awaiter(void 0, void 0, void 0, function* () {
    updateInputBrand.value = "";
    updateInputName.value = "";
    updateInputConsumptionPerHour.value = "";
    updateInputHoursPerDay.value = "";
    updateModalStatus.classList.add("loading");
    updateDeviceBtn.click();
    let deviceId = e.currentTarget.getAttribute("data-id");
    let req = yield fetch(route("api.getDevice", { id: deviceId }), {
        method: "GET",
        headers: {
            Authorization: updateRememberTokenInput.value
        }
    });
    let res = yield req.json();
    if (res.status == 200) {
        updateInputBrand.value = res.device.brand;
        updateInputName.value = res.device.name;
        updateInputConsumptionPerHour.value = res.device.consumption_per_hour.toString();
        updateInputHoursPerDay.value = res.device.hours_per_day.toString();
        selectedRowToUpdate = e.target.parentElement.parentElement.parentElement;
        selectedDeviceId = Number.parseInt(deviceId);
    }
    updateModalStatus.classList.remove("loading");
});
paginationPreviousBtn.addEventListener("click", (e) => {
    e.preventDefault();
    if (currentPage - 1 > 0) {
        currentPage--;
        getDevices();
    }
});
paginationBtn1.addEventListener("click", (e) => {
    e.preventDefault();
    let page = parseInt(paginationBtn1.getAttribute("data-page"));
    if (page <= totalPages) {
        activePagination.parentElement.classList.remove("active");
        paginationBtn1.parentElement.classList.add("active");
        activePagination = paginationBtn1;
        currentPage = page;
        getDevices();
    }
});
paginationBtn2.addEventListener("click", (e) => {
    e.preventDefault();
    let page = parseInt(paginationBtn2.getAttribute("data-page"));
    if (page <= totalPages) {
        activePagination.parentElement.classList.remove("active");
        paginationBtn2.parentElement.classList.add("active");
        activePagination = paginationBtn2;
        currentPage = page;
        getDevices();
    }
});
paginationBtn3.addEventListener("click", (e) => {
    e.preventDefault();
    let page = parseInt(paginationBtn3.getAttribute("data-page"));
    if (page <= totalPages) {
        activePagination.parentElement.classList.remove("active");
        paginationBtn3.parentElement.classList.add("active");
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
});
const validatePagination = () => __awaiter(void 0, void 0, void 0, function* () {
    if (totalPages >= 3) {
        if (currentPage < 2) {
            paginationPreviousBtn.parentElement.classList.add("disabled");
        }
        else {
            paginationPreviousBtn.parentElement.classList.remove("disabled");
        }
        let btn1Page = `${((currentPage == 1) ? currentPage : currentPage - 1)}`;
        paginationBtn1.setAttribute("data-page", btn1Page);
        paginationBtn1.innerText = btn1Page;
        (currentPage >= 1) ? paginationBtn1.parentElement.classList.remove("disabled") : paginationBtn1.parentElement.classList.add("disabled");
        (currentPage != 1) ? paginationBtn1.parentElement.classList.remove("active") : paginationBtn1.parentElement.classList.add("active");
        let btn2Page = `${((currentPage >= 2) ? currentPage : currentPage + 1)}`;
        paginationBtn2.setAttribute("data-page", btn2Page);
        paginationBtn2.innerText = btn2Page;
        (currentPage >= 1) ? paginationBtn2.parentElement.classList.remove("disabled") : paginationBtn2.parentElement.classList.add("disabled");
        (currentPage == parseInt(btn2Page)) ? paginationBtn2.parentElement.classList.add("active") : paginationBtn2.parentElement.classList.remove("active");
        let btn3Page = '';
        if (currentPage == 1) {
            btn3Page = `${currentPage + 2}`;
        }
        else {
            btn3Page = `${currentPage + 1}`;
        }
        paginationBtn3.setAttribute("data-page", btn3Page);
        paginationBtn3.innerText = btn3Page;
        (currentPage >= 1) ? paginationBtn3.parentElement.classList.remove("disabled") : paginationBtn3.parentElement.classList.add("disabled");
        (currentPage == parseInt(btn3Page)) ? paginationBtn3.parentElement.classList.add("active") : paginationBtn3.parentElement.classList.remove("active");
        if (currentPage + 1 > totalPages) {
            paginationNextBtn.parentElement.classList.add("disabled");
            (currentPage == totalPages) ? paginationBtn3.parentElement.classList.add("disabled") : paginationBtn3.parentElement.classList.remove("disabled");
        }
        else {
            paginationNextBtn.parentElement.classList.remove("disabled");
        }
    }
    else {
        paginationBtn1.setAttribute("data-page", "1");
        paginationBtn1.innerText = "1";
        paginationBtn2.setAttribute("data-page", "2");
        paginationBtn2.innerText = "2";
        paginationBtn3.setAttribute("data-page", "3");
        paginationBtn3.innerText = "3";
        if (currentPage == 1) {
            paginationPreviousBtn.parentElement.classList.add("disabled");
            paginationBtn1.parentElement.classList.remove("disabled");
            paginationBtn1.parentElement.classList.add("active");
            (totalPages == 2) ? paginationBtn2.parentElement.classList.remove("disabled") : paginationBtn2.parentElement.classList.add("disabled");
        }
        else {
            paginationPreviousBtn.parentElement.classList.remove("disabled");
            paginationBtn1.parentElement.classList.remove("active");
            (totalPages == 2) ? paginationNextBtn.parentElement.classList.remove("disabled") : paginationNextBtn.parentElement.classList.add("disabled");
        }
        if (currentPage == 2) {
            paginationBtn2.parentElement.classList.remove("disabled");
            paginationBtn2.parentElement.classList.add("active");
        }
        else {
            paginationBtn2.parentElement.classList.remove("active");
        }
        if (currentPage == totalPages) {
            paginationNextBtn.parentElement.classList.add("disabled");
        }
        else {
            paginationNextBtn.parentElement.classList.remove("disabled");
        }
        (totalPages < 3) ? paginationBtn3.parentElement.classList.add("disabled") : paginationBtn3.parentElement.classList.remove("disabled");
        (totalPages < 3) ? paginationNextBtn.parentElement.classList.add("disabled") : paginationNextBtn.parentElement.classList.remove("disabled");
        if (currentPage + 1 > totalPages) {
            paginationNextBtn.parentElement.classList.add("disabled");
            (currentPage == totalPages) ? paginationBtn3.parentElement.classList.add("disabled") : paginationBtn3.parentElement.classList.remove("disabled");
        }
        else {
            paginationNextBtn.parentElement.classList.remove("disabled");
        }
    }
});
document.addEventListener("DOMContentLoaded", (e) => {
    setTimeout(() => {
        getDevices();
    }, 200);
});
