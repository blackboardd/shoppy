import Navbar from '@/features/navbar/components';
import ProductList from '@/features/productList';

/**
 * Application entry point.
 *
 * @return {JSX.Element}
 */
export const App: () => JSX.Element = (): JSX.Element => {
  return (
    <div className="App">
      <Navbar>
        <ProductList />
      </Navbar>
    </div>
  );
};

export default App;
