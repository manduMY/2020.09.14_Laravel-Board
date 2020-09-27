<template>
  <div>
    <b-card>
      <div class="rounded-lg content-detail-content-info">
        <div class="content-detail-content-info-left">
          <div class="content-detail-content-info-left-number">
            글번호: {{content.id}}
          </div>
          </div>

          <div class="content-detail-content-info-center">
          <div class="content-detail-content-info-center-subject">
            {{content.title}}
          </div>
        </div>

        <div class="content-detail-content-info-right">
          <div class="content-detail-content-info-right-created">
            등록일: {{content.created_at}}
          </div>
        </div>
      </div>
      <div class="rounded-lg content-detail-content">
        {{content.context}}
      </div>
      <div class="content-detail-button">
        <b-button variant="info" @click="updateData">수정</b-button>
        <b-button variant="info" @click="deleteData()">삭제</b-button>
      </div>
    </b-card>
  </div>
</template>

<script>
import { deleteContent } from '../service/crud'
export default {
  name: "ContentDetail",
  data() {
            return {
                content: []
            }
        },
        created() {
            this.axios
                .get(`/api/findContent/${this.$route.params.id}`)
                .then((response) => {
                    this.content = response.data;
                });
        },
  methods: {
    async deleteData() {
      if(this.content.id > 0) {
        await deleteContent({content_id: this.content.idqq});
        alert("게시물이 삭제 되었습니다.");
        this.$router.push({name: 'Board'});
      } else {
        alert("상세 페이지 로딩중입니다. 잠시만 기다려주세요!");
      }
    },
    updateData() {
      if(this.content.id > 0) {
        this.$router.push({
        path: `/create/${this.content.id}`
      });
      } else {
        // 예외 처리: content.id 로딩중에 수정 버튼 누르면 로딩 안되게 하기 위해.
        alert("상세 페이지 로딩중입니다. 잠시만 기다려주세요!");
      }
      
    }
  }
};
</script>

<style scoped>
.b-button {
  color: #17A2B8;
}
.content-detail-content-info {
  border: 1px solid black;
  display: flex;
  justify-content: space-between;
}
.content-detail-content-info-left {
  width: 300px;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
}
.content-detail-content-info-center {
  width: 500px;
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  padding: 1rem;
}
.content-detail-content-info-right {
  width: 350px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 1rem;
}
.content-detail-content {
  border: 1px solid black;
  margin-top: 1rem;
  padding-top: 1rem;
  min-height: 720px;
}
.content-detail-button {
  margin-top: 1rem;
  padding: 2rem;
}
</style>