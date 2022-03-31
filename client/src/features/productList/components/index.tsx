import Product from '@/features/product/components';
import { ProductProvider } from '@/features/product/services/productProvider';
import { IProduct } from '../../product/components/interface';

/**
 * Component for the product list.
 */
const ProductList = async (): Promise<JSX.Element> => {
  const products = ProductProvider.getProducts();

  return (
    <ul className="product-list">
      {(await products).map((product: IProduct) => (
        <li key={product.id}>
          <Product product={product} />
        </li>
      ))}
    </ul>
  );
};

export default ProductList;
