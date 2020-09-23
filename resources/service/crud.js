import axios from "axios";

export function findContentList() {
    const promise = axios.get("/api/content_list");

    const dataPromise = promise.then((response) => response.data);

    return dataPromise;
};
export const addContent = ({ title, context }) => {
    return axios.post("/api/create", {
      title,
      context
    }).catch(error => {
      console.log(error.response);
    });
  };
  
  export const deleteContent = ({ content_id }) => {
    console.log(`content_id:` + content_id);
    axios.delete(`/api/delete/${content_id}`)
         .then((response) => {
         });
  };