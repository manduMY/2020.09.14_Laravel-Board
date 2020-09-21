import axios from "axios";

export function findContentList() {
    const promise = axios.get("/api/content");

    const dataPromise = promise.then((response) => response.data);

    return dataPromise;
};
