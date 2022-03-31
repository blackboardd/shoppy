import Navbar from '@/features/navbar/components';
import ProductList from '@/features/productList/components';

/**
 * Application entry point.
 *
 * @return {JSX.Element}
 */
export const App: () => JSX.Element = (): JSX.Element => {
  let productList = <></>;
  ProductList().then(
    (value: JSX.Element) => {
      productList = value;
    },
    (error: Error) => {
      console.error(error);
    }
  );

  return (
    <div className="App">
      <Navbar>{productList}</Navbar>
    </div>
  );
};

export default App;
