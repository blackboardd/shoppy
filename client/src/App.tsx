import Navbar from '@/features/navbar/components';

/**
 * Application entry point.
 *
 * @return {JSX.Element}
 */
export const App: () => JSX.Element = (): JSX.Element => {
  return (
    <div className="App">
      <Navbar>
        <h1>Hello world!</h1>
      </Navbar>
    </div>
  );
};

export default App;
