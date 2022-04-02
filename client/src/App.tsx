import Navbar from '@/features/navbar/components';
import ProductList from '@/features/productList';
import AddButton from './features/addButton/components';
import FloatingButtons from './features/floatingButtons/components';
import MassDeleteButton from './features/massDeleteButton/components';

/**
 * Application entry point.
 *
 * @return {JSX.Element}
 */
export const App: () => JSX.Element = (): JSX.Element => {
  return (
    <div className="App">
      <Navbar>
        <FloatingButtons />
        <ProductList />
      </Navbar>
    </div>
  );
};

export default App;
