import AddButton from '@/features/addButton/components';
import MassDeleteButton from '@/features/massDeleteButton/components';
import { IFloatingButtonsProps } from './interface';
import './styles.scss';

/**
 * Floating button component.
 *
 * @param {IFloatingButtonsProps} props - The props.
 * @returns {JSX.Element}
 */
const FloatingButtons = (props: IFloatingButtonsProps): JSX.Element => {
  const { handleDelete } = props;

  return (
    <div className="btn-float-container">
      <AddButton />
      <MassDeleteButton handleDelete={handleDelete} />
    </div>
  );
};

export default FloatingButtons;
