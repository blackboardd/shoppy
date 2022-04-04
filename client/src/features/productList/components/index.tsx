import { useEffect, useState } from 'react';
import Product from '@/features/product/components';
import { IProduct } from '@/features/product/components/interface';
import { ProductProvider } from '@/features/product/services/productProvider';
import './styles.scss';
import FloatingButtons from '../../floatingButtons/components';
import { IChecked } from './interface';
import * as Sentry from '@sentry/react';
import 'regenerator-runtime/runtime';

/**
 * Application entry point.
 *
 * @return {JSX.Element}
 */
const ProductList: () => JSX.Element = (): JSX.Element => {
  // call productprovider getProducts function as await function
  // set list to nothing if fetch fails, but if it succeeds, set it to the result
  const [products, setProducts] = useState<IProduct[]>([]);

  useEffect(() => {
    ProductProvider.getProducts().then(
      (result) => {
        setProducts(result);
      },
      (error) => {
        Sentry.captureException(error);
      }
    );
  }, []);

  const productList: JSX.Element[] = [];

  const [checked, setChecked] = useState<IChecked>({});

  // div className="product" should have an onClick function that calls setChecked
  // handleClick that takes in the id of the parent div through a mouse event
  const handleClick = (event: React.MouseEvent<HTMLDivElement>): void => {
    // while the element is not a list item move up the DOM tree
    while (event.currentTarget.nodeName !== 'LI') {
      event.currentTarget = event.currentTarget.parentElement as EventTarget &
        HTMLDivElement;
    }

    const id = event.currentTarget.id;

    setChecked((prevState) => ({
      ...prevState,
      [id]: prevState[id] === undefined ? true : !prevState[id],
    }));
  };

  // WCAG 2.1.1 onKeyDown
  const handleKeyDown = (event: React.KeyboardEvent<HTMLDivElement>): void => {
    // while the element is not a list item move up the DOM tree
    while (event.currentTarget.nodeName !== 'LI') {
      event.currentTarget = event.currentTarget.parentElement as EventTarget &
        HTMLDivElement;
    }

    const id = event.currentTarget.id;

    if (event.key === 'Enter') {
      setChecked((prevState) => ({
        ...prevState,
        [id]: prevState[id] === undefined ? true : !prevState[id],
      }));
    }
  };

  products.forEach((product) => {
    productList.push(
      <li key={product.product_id} id={`product__${product.product_id}`}>
        <Product
          checked={checked[`product__${product.product_id}`] ?? false}
          handleClick={handleClick}
          handleKeyDown={handleKeyDown}
          product={product}
        />
      </li>
    );
  });

  /**
   * Function to send a request to the server to delete all of the products
   * marked true in checked.
   *
   * @return {Promise<void>}
   */
  const deleteProducts = async (): Promise<void> => {
    const checkedProducts = Object.keys(checked).filter(
      (key) => checked[key] === true
    );

    // eslint-disable-next-line no-restricted-syntax
    for (const productId of checkedProducts) {
      // remove product__ from the id
      const id = productId.replace('product__', '');

      // convert id to number
      const productIdNum = parseInt(id, 10);

      await ProductProvider.deleteProduct(productIdNum);
    }
  };

  /**
   * Function to call deleteProducts asynchronously and then refresh the page
   */
  const handleDelete = (): void => {
    // call deleteProducts and .then() to trigger the useEffect to render the product list. Don't refresh the page
    deleteProducts().then(() => {
      setProducts(() => {
        setChecked({});
        return products.filter(
          (product) => !checked[`product__${product.product_id}`]
        );
      });
    });
  };

  return (
    <div className="product-list-container">
      <FloatingButtons handleDelete={handleDelete} />
      <ul className="product-list">{productList.reverse()}</ul>
    </div>
  );
};

export default ProductList;
