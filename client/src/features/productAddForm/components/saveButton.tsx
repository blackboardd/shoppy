import { Save2Fill } from 'react-bootstrap-icons';
import './buttons.styles.scss';

/**
 * Save button component.
 *
 * @returns {JSX.Element} The save button component.
 */
const SaveButton = (): JSX.Element => {
  return (
    <button
      type="submit"
      className="btn btn-primary product-form-button btn-icon"
      form="product_form"
    >
      <div className="icon">
        {' '}
        <Save2Fill />
      </div>
      <p style={{ marginBottom: 0 }}>SAVE</p>
    </button>
  );
};

export default SaveButton;
