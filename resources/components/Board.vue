<template>
  <div>
    <b-table 
      striped hover 
      :per-page="perPage"
      :current-page="currentPage" 
      :items="items" 
      :fields="fields" 
      ></b-table>
    <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      align="center"
    ></b-pagination>
    <b-button @click="writeContent">글쓰기</b-button>
  </div>
</template>

<script>
import {findContentList} from '../service/crud'

export default {
  async created() {
    const ret = await findContentList();
    this.items = ret.data.sort((a,b) => {return b.context_id - a.context_id});
  },
  data() {
    return {
      currentPage: 1,
      perPage: 10,
      fields: [
        {
          key: 'context_id',
          label: '글번호',
        },
        {
          key: 'title',
          label: '제목',
        },
        {
          key: 'created_at',
          label: '등록일'
        }
      ],
      items: []
    }
  },
  computed: {
    rows() {
      return this.items.length
    }
  },
  methods: {
    writeContent() {

      this.$router.push({
        path: '/create'
      })
    }
  }
}
</script>