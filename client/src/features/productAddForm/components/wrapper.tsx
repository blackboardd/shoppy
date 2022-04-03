import { IWrapperProps } from './wrapper.interface';
import './wrapper.styles.scss';

/**
 * Wrapper component.
 *
 * @param {IWrapperProps} props.
 * @return {JSX.Element} The wrapper component.
 */
const Wrapper = (props: IWrapperProps): JSX.Element => {
  const { children } = props;

  return <div className="wrapper">{children}</div>;
};

export default Wrapper;
