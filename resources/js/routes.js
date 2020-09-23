import Board from '../components/Board.vue';
import Create from '../components/Create.vue';
import ContentDetail from '../components/ContentDetail.vue';

export const routes = [
    {
        path: '/',
        name: 'Board',
        component: Board
    },
    {
        path: '/detail/:id',
        name: 'ContentDetail',
        component: ContentDetail
    },
    {
        path: '/create/:id?',
        name: 'Create',
        component: Create
    }
];