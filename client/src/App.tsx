import Navbar from '@/features/navbar/components';
import ProductList from '@/features/productList/components';
import ProductAdd from '@/features/productAdd/components';
import { BrowserRouter, Route, Routes } from 'react-router-dom';

/**
 * Application entry point.
 *
 * @return {JSX.Element}
 */
export const App: () => JSX.Element = (): JSX.Element => {
  return (
    <BrowserRouter>
      <Routes>
        <Route
          path="/"
          element={
            <Navbar>
              <ProductList />
            </Navbar>
          }
        />
        <Route
          path="/add/"
          element={
            <Navbar>
              <ProductAdd />
            </Navbar>
          }
        />
      </Routes>
    </BrowserRouter>
  );
};

export default App;
