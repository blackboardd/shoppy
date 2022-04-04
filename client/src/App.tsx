import { Routes, Route, BrowserRouter } from 'react-router-dom';

/**
 * Application entry point.
 *
 * @return {JSX.Element}
 */
const App: () => JSX.Element = (): JSX.Element => {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<h1>Hello world!</h1>} />
        <Route path="/add" element={<h1>Hello add!</h1>} />
      </Routes>
    </BrowserRouter>
  );
};

export default App;
