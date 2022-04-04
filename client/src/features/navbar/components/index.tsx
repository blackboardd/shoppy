import Header from '@/features/navbar/components/header';
import Footer from '@/features/navbar/components/footer';
import { INavbarProps } from './interface';

import './styles.scss';

/**
 * Navigation bar footer.
 *
 * @param {INavbarProps} props - children of navigation bar
 *
 * @returns {JSX.Element}
 */
const Navbar = (props: INavbarProps): JSX.Element => {
  const { children } = props;

  return (
    <div className="navbar-container">
      <Header />
      <div className="navbar-content">{children}</div>
      <Footer />
    </div>
  );
};

export default Navbar;
