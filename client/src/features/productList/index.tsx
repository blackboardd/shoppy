import { useEffect, useState } from 'react';
import Product from '@/features/product/components';
import { IProduct } from '@/features/product/components/interface';
import { ProductProvider } from '@/features/product/services/productProvider';
import './styles.scss';

/**
 * Application entry point.
 *
 * @return {JSX.Element}
 */
export const ProductList: () => JSX.Element = (): JSX.Element => {
  // call productprovider getProducts function as await function
  // set list to nothing if fetch fails, but if it succeeds, set it to the result
  const [products, setProducts] = useState<IProduct[]>([]);

  useEffect(() => {
    ProductProvider.getProducts().then(
      (result) => {
        setProducts(result);
      },
      (error) => {
        console.log(error);
      }
    );
  }, []);

  let productList: JSX.Element[] = [];

  products.forEach((product) => {
    productList.push(
      <li key={product.product_id}>
        <Product product={product} />
      </li>
    );
  });

  return (
    <ul className="product-list">
      {productList}
    </ul>
  );
};

export default ProductList;

