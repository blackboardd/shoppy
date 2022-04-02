import AddButton from '@/features/addButton/components';
import MassDeleteButton from '@/features/massDeleteButton/components';
import './styles.scss';

/**
 * Floating button component.
 * 
 * @returns {JSX.Element}
 */
const FloatingButtons = (): JSX.Element => {
  return (
    <div className="btn-float">
      <div className="btn-float-container">
        <AddButton />
        <MassDeleteButton />
      </div>
    </div>
  );
};


export default FloatingButtons;
