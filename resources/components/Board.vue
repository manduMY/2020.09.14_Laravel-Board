<template>
  <div>
    <b-table 
      striped hover 
      :per-page="perPage"
      :current-page="currentPage" 
      :items="items" 
      :fields="fields" 
      @row-clicked="rowClick"></b-table>
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
  name: "Board",
  async created() {
    const ret = await findContentList();
    this.items = ret.data;
  },
  data() {
    return {
      currentPage: 1,
      perPage: 10,
      fields: [
        {
          key: 'id',
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
      return this.items.length;
    }
  },
  methods: {
    rowClick(item, index, e) {
      this.$router.push({
        path: `/detail/${item.id}`
      })
    },
    writeContent() {
      this.$router.push({
        path: '/create'
      })
    }
  }
  };
</script>