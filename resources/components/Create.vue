<template>
  <div>
    <b-input v-model="subject" placeholder="제목을 입력해 주세요"></b-input>
    <b-form-textarea v-model="context" placeholder="내용을 입력해 주세요" rows="3" max-rows="6"></b-form-textarea>
    <b-button @click="updateMode ? updateContent() : uploadContent()">저장</b-button>
    <b-button @click="cancle">취소</b-button>
  </div>
</template>
<script>
import { addContent } from "../service/crud";

export default {
  name: 'Create',
  data() {
      console.log("route : "+this.$route.params.id);
    return {
      subject: "",
      context: "",
      updateMode: this.$route.params.id > 0 ? true : false,
      content: [],
    };
  },
  async created() {
    if (this.$route.params.id > 0) {
      this.axios
          .get(`/api/find_content/${this.$route.params.id}`)
          .then((response) => {
              this.content = response.data;
              this.subject = this.content.title;
              this.context = this.content.context;
     });
    }
  },
  methods: {
    async uploadContent() {
      // 타이틀 제목 여부 확인 후 axios 동작.
      if(this.subject) {
        await addContent({
        title: this.subject,
        context: this.context
      });
      this.$router.push({name: 'Board'});
      } else {
        alert("제목을 입력해주세요!!!");
      }
    },
    async updateContent() {
      // 타이틀 제목 여부 확인 후 axios 동작.
      if(this.subject) {
        this.content.title = this.subject;
        this.content.context = this.context;
        this.axios.put(`/api/update/${this.$route.params.id}`, this.content)
                  .then((response) => {
                      this.$router.push({name: 'Board'});
        }).catch(error => {
          console.log(error.response);
        });
      } else {
        alert("제목을 입력해주세요!!!");
      }
    },
    cancle() {
      this.$router.push({name: 'Board'});
    }
  }
};
</script>