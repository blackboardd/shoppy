import { TrashFill } from 'react-bootstrap-icons';
import { IMassDeleteButtonProps } from './interface';

/**
 * Mass delete button component.
 *
 * @param {IMassDeleteButtonProps} props - The props.
 * @returns {JSX.Element}
 */
const MassDeleteButton = (props: IMassDeleteButtonProps): JSX.Element => {
  const { handleDelete } = props;

  return (
    <div className="btn-mass-delete">
      <button
        className="btn-float btn btn-primary btn-lg btn-icon"
        onClick={handleDelete}
      >
        <p style={{ marginBottom: 0 }}>MASS DELETE</p>
        <div className="floating-btn-icon">
          {' '}
          <TrashFill />
        </div>
      </button>
    </div>
  );
};

export default MassDeleteButton;
