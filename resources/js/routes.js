import Board from '../components/Board.vue';
import Create from '../components/Create.vue';
import ContentDetail from '../components/ContentDetail.vue';

export const routes = [
    {
        path: '/',
        name: 'home',
        component: Board
    },
    {
        path: '/create/:context_id?',
        name: 'create',
        component: Create
    },
    {
        path: '/detail/:context_id',
        name: 'ContentDetail',
        component: ContentDetail
    }
];