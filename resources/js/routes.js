import Home from './components/Home';
import Products from './components/Products';
import Ingredients from './components/Ingredients';
import Form from './components/Ingredients/Form'
import Categories from './components/Categories';
import CategoriesForm from "./components/Categories/CategoriesForm";
import Brands from './components/Brands'
import BrandsForm from './components/Brands/BrandsForm'
import NotFound from './components/NotFound';
import ProductForm from "./components/Products/ProductForm";



export default {
  mode: 'history',
  linkActiveClass: 'font-bold',

  routes: [
    {
      path: '/be16f422-d3c8-11e9-bb65-2a2ae2dbcce4',
      component: Products
    },
    {
      path: '/',
      component: Products
    },
    {
      path: '/products',
      component: Products,
      name: 'products'

    },
    {
      path: '*',
      component: NotFound
    },
    // {
    //   path: '/products/new',
    //   component: ProductForm,
    //   name: 'new-product'
    //
    // },
    // {
    //   path: '/ingredients',
    //   component: Ingredients,
    //   name: 'ingredients',
    // },
    // {
    //   path: '/ingredients/new',
    //   component: Form,
    //   name: 'new-ingredient'
    // },
    // {
    //   path: '/ingredients/:id/edit',
    //   component: Form,
    //   name: 'edit-ingredient'
    // },
    // {
    //   path: '/categories',
    //   component: Categories,
    //   name: 'categories'
    // },
    // {
    //   path: '/categories/new',
    //   name: 'newCategory',
    //   component: CategoriesForm
    // },
    // {
    //   path: '/categories/:id/edit',
    //   component: CategoriesForm,
    //   name: 'edit-category'
    // },
    // {
    //   path:'/brands',
    //   name: 'brands',
    //   component: Brands
    // },
    // {
    //   path:'/brands/new',
    //   name: 'newBrand',
    //   component: BrandsForm
    // },
    // {
    //   path: '/brands/:id/edit',
    //   name: 'editBrand',
    //   component: BrandsForm
    // }
  ]
}
