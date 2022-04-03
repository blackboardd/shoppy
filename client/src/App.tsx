import Navbar from '@/features/navbar/components';
import ProductList from '@/features/productList/components';
import { Routes, Route } from 'react-router';
import ProductAdd from '@/features/productAdd/components';

/**
 * Application entry point.
 *
 * @return {JSX.Element}
 */
export const App: () => JSX.Element = (): JSX.Element => {
  return (
    <Navbar>
      <Routes>
        <Route path="/" element={<ProductList />} />
        <Route path="add" element={<ProductAdd />} />
      </Routes>
    </Navbar>
  );
};

export default App;
